<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Template;
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
            'wedding_date' => 'required|date',
            'location' => 'required|string|max:255',
            'place_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'phone' => 'required|string|max:20',
            'template_id' => 'required|exists:templates,id',
        ]);
    
        $template = Template::findOrFail($request->template_id);
    
        $order = Order::create([
            'user_id' => null, // atau auth()->id() kalau user sudah login
            'kode_transaksi' => 'WD_ORDER_' . strtoupper(Str::uuid()->toString()),
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'wedding_date' => $request->wedding_date,
            'location' => $request->location,
            'place_name' => $request->place_name,
            'description' => $request->description,
            'phone_number' => $request->phone,
            'template_id' => $template->id,
            'payment_total' => $template->price,
            'payment_proof' => null,
            'status' => 'pending',
        ]);
    
        return redirect()->route('orders.success', $order->kode_transaksi)->with('toast', [
            'type' => 'success',
            'message' => 'Pesanan berhasil dibuat!',
            'timer' => 3000,
        ]);
    }
    

    public function success($kode_transaksi)
    {
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();
        return view('orders.success', compact('order'));
    }
}
