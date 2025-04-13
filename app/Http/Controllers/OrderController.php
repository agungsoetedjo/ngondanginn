<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Template;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function create()
    {
        // Ambil semua data template dari database
        $templates = Template::all(); 
    
        // Kirim data templates ke view
        return view('order.create', compact('templates'));
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
            'template_id' => 'required|exists:designs,id',
        ]);

        $order = Order::create([
            'user_id' => null,
            'kode_transaksi' => 'WD_ORDER_' . strtoupper(Str::uuid()->toString()), // Menggunakan UUID untuk memastikan unik
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'wedding_date' => $request->wedding_date,
            'location' => $request->location,
            'place_name' => $request->place_name,
            'description' => $request->description,
            'phone' => $request->phone,
            'template_id' => $request->template_id,
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
