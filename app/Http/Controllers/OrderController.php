<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Music;
use App\Models\Order;
use App\Models\PaymentDest;
use App\Models\Template;
use App\Models\Wedding;

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
            'akad_location' => 'required|string|max:255',
            'akad_place_name' => 'nullable|string|max:255',
            'reception_location' => 'required|string|max:255',
            'reception_place_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'phone_number' => 'required|string|max:20',
            'template_id' => 'required|exists:templates,id',
            'music_id' => 'nullable|exists:musics,id',
        ]);
    
        // 1. Simpan ke tabel orders
        $order = Order::create([
            'kode_transaksi' => 'WD_ORDER_' . Str::upper(uniqid()),
            'nama_pemesan' => $request->nama_pemesan,
            'phone_number' => $request->phone_number,
            'status' => 'created',
        ]);
    
        // 2. Simpan ke tabel weddings
        Wedding::create([
            'user_id' => null,
            'order_id' => $order->id,
            'template_id' => $request->template_id,
            'music_id' => $request->music_id,
            'slug' => Str::slug($request->groom_name . '-' . $request->bride_name . '-' . Str::random(5)),
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'bride_parents_info' => $request->bride_parents_info,
            'groom_parents_info' => $request->groom_parents_info,
            'akad_date' => $request->akad_date,
            'reception_date' => $request->reception_date,
            'akad_location' => $request->akad_location,
            'akad_place_name' => $request->akad_place_name,
            'reception_location' => $request->reception_location,
            'reception_place_name' => $request->reception_place_name,
            'description' => $request->description,
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
        $order = Order::with(['wedding.template','payment'])->where('kode_transaksi', $kode_transaksi)->firstOrFail();
        $templates = Template::all(); // Kirim semua template ke view
        $paymentDests = PaymentDest::all();
        return view('order.hasil-cek', compact('order','templates','paymentDests'));
    }

    // dikelola oleh Pengelola Undangan cooooyyyy
    public function adminIndex()
    {
        // Pastikan user yang sedang login memiliki role_id 1 (pengelola)
        if (Auth::user()->role_id != 1) {
            // Jika bukan pengelola, redirect atau beri pesan error
            session()->flash('sweetalert', [
                'type' => 'error',
                'message' => 'Anda tidak memiliki akses untuk melihat data pesanan.'
            ]);
        }

        $orders = Order::with('wedding')
            ->whereIn('status', ['created','processed', 'published'])
            ->whereHas('wedding', function ($query) {
                $query->whereNull('user_id')
                      ->orWhere('user_id', Auth::id());
            })
            ->latest()
            ->get();
    
        return view('backend.orders.index', compact('orders'));
    }

    public function adminShow($kode_transaksi)
    {
        $musics = Music::all();
        // Mencari order berdasarkan kode transaksi
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();

        return view('backend.orders.show', compact('order','musics'));
    }

    public function assignOrder($kode_transaksi)
    {
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();

        $order->wedding->update([
            'user_id' => Auth::id(),
        ]);

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Pesanan berhasil dikelola oleh Anda.'
        ]);
    
        return redirect()->route('orders.index', $order->kode_transaksi);
    }

    public function updateTemplate(Request $request, $kode_transaksi)
    {
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();

        if (!in_array($order->payment->payment_status, ['pending', 'rejected'])) {
            return back()->with('error', 'Template hanya bisa diganti saat status pending atau rejected.');
        }

        $request->validate([
            'template_id' => 'required|exists:templates,id',
        ]);

        $template = Template::find($request->template_id);

        // Update wedding & total pembayaran
        $order->wedding->update([
            'template_id' => $template->id,
        ]);

        $order->payment->update([
            'payment_total' => $template->price,
        ]);

        return back()->with('success', 'Template berhasil diperbarui.');
    }

    // pesanan yang sudah selesai

    public function indexArchive()
    {
        // Pastikan user yang sedang login memiliki role_id 1 (pengelola)
        if (Auth::user()->role_id != 1) {
            // Jika bukan pengelola, redirect atau beri pesan error
            session()->flash('sweetalert', [
                'type' => 'error',
                'message' => 'Anda tidak memiliki akses untuk melihat data pesanan.'
            ]);
        }
        
        $orders = Order::with('wedding')
            ->whereIn('status', ['completed'])
            ->whereHas('wedding', function ($query) {
                $query->whereNull('user_id')
                      ->orWhere('user_id', Auth::id());
            })
            ->latest()
            ->get();
    
        return view('backend.orders.index', compact('orders'));
    }

    public function showArchive($kode_transaksi)
    {
        $musics = Music::all();
        // Mencari order berdasarkan kode transaksi
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();

        return view('backend.orders.show', compact('order','musics'));
    }

}
