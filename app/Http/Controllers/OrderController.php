<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Template;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function create()
    {
        // Ambil semua data template dan music dari database
        $musics = Music::all(); 
        $templates = Template::all(); 
    
        // Kirim data templates ke view
        return view('order.create', compact('templates','musics'));
    }
    

    public function store(Request $request)
    {
        $request->validate([
            'bride_name' => 'required|string|max:100',
            'groom_name' => 'required|string|max:100',
            'bride_parents_info' => 'nullable|string|max:255',
            'groom_parents_info' => 'nullable|string|max:255',
            'akad_date' => 'nullable|date',
            'reception_date' => 'nullable|date',
            'location' => 'required|string|max:255',
            'place_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'phone_number' => 'required|string|max:20',
            'template_id' => 'required|exists:templates,id',
            'music_id' => 'nullable|exists:musics,id',
        ]);
    
        $template = Template::findOrFail($request->template_id);
    
        $order = Order::create([
            'user_id' => null,
            'template_id' => $request->template_id,
            'music_id' => $request->music_id,
            'kode_transaksi' => 'WD_ORDER_' . Str::upper(uniqid()),
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'bride_parents_info' => $request->bride_parents_info,
            'groom_parents_info' => $request->groom_parents_info,
            'akad_date' => $request->akad_date,
            'reception_date' => $request->reception_date,
            'place_name' => $request->place_name,
            'location' => $request->location,
            'description' => $request->description,
            'phone_number' => $request->phone_number,
            'payment_total' => $template->price ?? 0,
            'payment_proof' => null,
            'status' => 'pending', // belum ada bukti transfer
        ]);
    
        return redirect()->route('order.create')->with('order_success', [
            'kode_transaksi' => $order->kode_transaksi,
        ]);
    }

    public function cekForm()
    {
        return view('order.cek-pesanan'); // form input
    }

    public function cekPesanan(Request $request)
    {
        $order = Order::where('kode_transaksi', $request->kode)->first();
    
        if (!$order) {
            return redirect()->route('order.cek.form')
                             ->with('error', 'Kode transaksi tidak ditemukan!');
        }
    
        return redirect()->route('order.cek.result', ['kode_transaksi' => $request->kode]);
    }

    public function hasilPesanan($kode_transaksi)
    {
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();
        return view('order.hasil-cek', compact('order'));
    }

    public function uploadBukti(Request $request, $kode_transaksi)
    {
        $request->validate([
            'phone_number' => 'required|numeric',
            'bukti_transfer' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $order = Order::where('kode_transaksi', $kode_transaksi)->first();
    
        if (!$order) {
            return redirect()->back()->with('error', 'Order tidak ditemukan.');
        }
    
        if ($order->phone_number !== $request->phone_number) {
            return redirect()->back()->with('error', 'Nomor HP yang Anda masukkan tidak cocok dengan data pemesan.');
        }
    
        $file = $request->file('bukti_transfer');
    
        // Buat nama unik pakai UUID
        $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('uploads/payment_proof'), $fileName);
    
        // Update order
        $order->update([
            'payment_proof' => $fileName,
            'status' => 'waiting_verify',
        ]);
    
        session()->flash('success', 'Bukti pembayaran berhasil diunggah!');
    
        return redirect()->route('order.cek.result', $order->kode_transaksi);
    }
    
    
    // dikelola oleh Pengelola Undangan cooooyyyy

    public function adminIndex()
    {
        $orders = Order::whereIn('status', ['pending', 'waiting_verify', 'paid', 'processed', 'active', 'completed'])
            ->where(function ($query) {
                $query->where('user_id', Auth::id())
                      ->orWhereNull('user_id');
            })
            ->latest()
            ->get();
    
        return view('backend.orders.index', compact('orders'));
    }

    public function adminShow($kode_transaksi)
    {
        // Mencari order berdasarkan kode transaksi
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();

        return view('backend.orders.show', compact('order'));
    }

    public function adminApprove($kode_transaksi)
    {
        // Cari order berdasarkan kode transaksi
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();

        // Update status menjadi "approved" atau sesuai dengan logika yang diinginkan
        $order->update([
            'status' => 'paid',  // Ubah status jika perlu
        ]);

        session()->flash('success', 'Pesanan berhasil disetujui.');

        return redirect()->route('admin.orders.show', $order->kode_transaksi);
    }

    public function adminReject($kode_transaksi)
    {
        // Cari order berdasarkan kode transaksi
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();

        // Cek jika ada bukti transfer yang diunggah, maka hapus file-nya
        if ($order->payment_proof) {
            $filePath = public_path($order->payment_proof);
            
            if (file_exists($filePath)) {
                unlink($filePath); // Hapus file bukti transfer
            }
        }

        // Update status menjadi "pending" dan reset bukti transfer
        $order->update([
            'status' => 'pending', // Kembalikan status menjadi pending
            'payment_proof' => null, // Hapus bukti transfer
        ]);

        session()->flash('error', 'Pesanan ditolak. Bukti transfer telah dihapus.');

        return redirect()->route('admin.orders.show', $order->kode_transaksi);
    }

    public function assignOrder($kode_transaksi)
    {
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();

        $order->update([
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('admin.orders.index')->with('success', 'Order berhasil di-assign ke Anda.');
    }

}
