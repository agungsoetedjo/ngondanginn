<?php

namespace App\Http\Controllers;

use App\Mail\PaymentEInvoiceMail;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PaymentController extends Controller
{
    public function index()
    {
        $orders = Order::with('payment')  // Mengambil data payment yang terhubung
            ->whereHas('payment', function ($query) {  // Filter berdasarkan payment_status di tabel payments
                $query->whereIn('payment_status', ['pending', 'rejected', 'waiting_verify', 'paid']);
            })
            ->latest()
            ->get();

        return view('backend.payments.index', compact('orders'));
    }


    public function showPayment($kode_transaksi)
    {
        $order = Order::with('payment.paymentDest') // akses lewat payment
            ->where('kode_transaksi', $kode_transaksi)
            ->firstOrFail();

        return view('backend.payments.show', compact('order'));
    }

    public function uploadBukti(Request $request, $kode_transaksi)
    {
        $request->validate([
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'payment_dests_id' => 'required|exists:payment_dests,id',
        ]);

        $order = Order::where('kode_transaksi', $kode_transaksi)->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Order tidak ditemukan.');
        }

        $file = $request->file('bukti_transfer');
        $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
        $path = 'uploads/payment_proof/' . $fileName;
        $file->move(public_path('uploads/payment_proof'), $fileName);

        $paymentTotal = $order->wedding && $order->wedding->template ? $order->wedding->template->price : 0;

        $payment = $order->payment;

        if ($payment && $payment->payment_status === 'rejected') {
            // Kalau sudah ada payment rejected → update
            $payment->update([
                'payment_total' => $paymentTotal,
                'payment_proof' => $path,
                'payment_dests_id' => $request->payment_dests_id,
                'payment_status' => 'waiting_verify',
            ]);
        } else {
            // Kalau belum ada payment → buat baru
            Payment::create([
                'order_id' => $order->id,
                'payment_total' => $paymentTotal,
                'payment_proof' => $path,
                'payment_desc' => null,
                'payment_dests_id' => $request->payment_dests_id,
                'payment_status' => 'waiting_verify',
                'user_id' => null,
            ]);
        }

        Mail::to($order->email_pemesan)->send(new PaymentEInvoiceMail($order));

        session()->flash('success', 'Bukti pembayaran berhasil diunggah!');

        return redirect()->route('order.cek.result', $order->kode_transaksi);
    }

    public function approvePayment($kode_transaksi)
    {
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();

        $payment = Payment::where('order_id', $order->id)->first();

        if ($payment) {
            $payment->update([
                'user_id' => Auth::id(),
                'payment_status' => 'paid',
                'payment_desc' => '-',
            ]);
        }

        Mail::to($order->email_pemesan)->send(new PaymentEInvoiceMail($order));

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Pembayaran berhasil disetujui.'
        ]);

        return redirect()->route('payments.index', $order->kode_transaksi);
    }

    public function rejectPayment(Request $request, $kode_transaksi)
    {
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();

        $payment = Payment::where('order_id', $order->id)->first();

        if ($payment) {
            $payment->update([
                'user_id' => Auth::id(),
                'payment_status' => 'rejected',
                'payment_desc' => $request->reason, // alasan dari SweetAlert
            ]);
        }

        Mail::to($order->email_pemesan)->send(new PaymentEInvoiceMail($order));

        session()->flash('sweetalert', [
            'type' => 'warning',
            'message' => 'Pembayaran ditolak. Alasan: ' . $request->reason
        ]);

        return redirect()->route('payments.index', $order->kode_transaksi);
    }

}
