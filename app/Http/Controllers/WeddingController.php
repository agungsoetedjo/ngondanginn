<?php

namespace App\Http\Controllers;

use App\Models\Music;
use App\Models\Order;
use App\Models\Template;
use App\Models\Wedding;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WeddingController extends Controller
{
    public function index()
    {
        $weddings = Wedding::with('order')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
    
        return view('backend.weddings.index', compact('weddings'));
    }

    public function create()
    {
        $musics = Music::all();  // Bisa ditambahin filter jika perlu
        $templates = Template::all();
        $wedding = Wedding::with('order')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();
        return view('backend.weddings.create', compact('templates', 'musics', 'wedding'));
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

        $kodeTransaksi = 'WD_ORDER_' . Str::upper(uniqid());
        $template = Template::find($request->template_id);

        // Buat order terlebih dahulu
        $order = Order::create([
            'user_id' => Auth::id(), // admin yang input
            'template_id' => $request->template_id,
            'music_id' => $request->music_id,
            'kode_transaksi' => $kodeTransaksi,
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'bride_parents_info' => $request->bride_parents_info,
            'groom_parents_info' => $request->groom_parents_info,
            'akad_date' => $request->akad_date ? Carbon::parse($request->akad_date) : null,
            'reception_date' => $request->reception_date ? Carbon::parse($request->reception_date) : null,
            'place_name' => $request->place_name,
            'location' => $request->location,
            'description' => $request->description,
            'phone_number' => $request->phone_number,
            'payment_total' => $template->price ?? 0,
            'payment_proof' => null,
            'status' => 'pending',
        ]);

        // Buat wedding sekaligus
        Wedding::create([
            'user_id' => Auth::id(),
            'order_id' => $order->id,
            'slug' => Str::slug($request->bride_name . '-' . $request->groom_name . '-' . now()->timestamp),
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'bride_parents_info' => $request->bride_parents_info,
            'groom_parents_info' => $request->groom_parents_info,
            'akad_date' => $request->akad_date ? Carbon::parse($request->akad_date) : null,
            'reception_date' => $request->reception_date ? Carbon::parse($request->reception_date) : null,
            'location' => $request->location,
            'place_name' => $request->place_name,
            'description' => $request->description,
            'template_id' => $request->template_id,
            'music_id' => $request->music_id,
        ]);

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Undangan dan data order berhasil dibuat!'
        ]);

        return redirect()->route('weddings.index');
    }


    public function edit($slug)
    {
        $wedding = Wedding::with(['order', 'templates', 'music'])
            ->where('user_id', Auth::id())
            ->where('slug', $slug)
            ->firstOrFail();

        $musics = Music::all();
        $templates = Template::all();

        return view('backend.weddings.edit', compact('wedding', 'templates', 'musics'));
    }


    public function update(Request $request, $slug)
    {
        $wedding = Wedding::where('user_id', Auth::id())
                        ->where('slug', $slug)
                        ->firstOrFail();

        $request->validate([
            'bride_name' => 'required|string|max:100',
            'groom_name' => 'required|string|max:100',
            'bride_parents_info' => 'required|string|max:255',
            'groom_parents_info' => 'required|string|max:255',
            'akad_date' => 'nullable|date',
            'reception_date' => 'nullable|date',
            'location' => 'required|string|max:255',
            'place_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'template_id' => 'nullable|exists:templates,id',
            'music_id' => 'nullable|exists:musics,id',
        ]);

        $slug = Str::slug($request->bride_name . '-' . $request->groom_name . '-' . now()->timestamp);

        // Siapkan data update wedding
        $weddingData = [
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'bride_parents_info' => $request->bride_parents_info,
            'groom_parents_info' => $request->groom_parents_info,
            'akad_date' => $request->akad_date ? Carbon::parse($request->akad_date) : null,
            'reception_date' => $request->reception_date ? Carbon::parse($request->reception_date) : null,
            'location' => $request->location,
            'place_name' => $request->place_name,
            'description' => $request->description,
            'music_id' => $request->music_id,
            'slug' => $slug,
        ];

        if ($wedding->order_id) {
            $order = Order::find($wedding->order_id);

            if ($order) {
                $orderData = [
                    'bride_name' => $request->bride_name,
                    'groom_name' => $request->groom_name,
                    'bride_parents_info' => $request->bride_parents_info,
                    'groom_parents_info' => $request->groom_parents_info,
                    'akad_date' => $request->akad_date,
                    'reception_date' => $request->reception_date,
                    'location' => $request->location,
                    'place_name' => $request->place_name,
                    'description' => $request->description,
                    'music_id' => $request->music_id,
                ];

                // Jika masih pending, baru izinkan update template_id
                if ($order->payment_status === 'pending') {
                    $weddingData['template_id'] = $request->template_id;
                    $orderData['template_id'] = $request->template_id;
                }

                $order->update($orderData);
            }
        }

        $wedding->update($weddingData);

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Undangan berhasil diupdate!'
        ]);

        return redirect()->route('weddings.index');
    }


    public function destroy($id)
    {
        $wedding = Wedding::where('user_id', Auth::id())
                      ->where('id', $id)
                      ->firstOrFail();
        $wedding->delete();

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Undangan berhasil dihapus!'
        ]);
    
        return redirect()->route('weddings.index');
    }

    public function show($id)
    {
        $wedding = Wedding::findOrFail($id);
        
        // Dapatkan template berdasarkan view_path
        $template = $wedding->template;

        // Pastikan template ada dan memiliki view_path
        if ($template && $template->view_path) {
            return view($template->view_path, compact('wedding'));
        }

        return redirect()->route('weddings.index')->with('error', 'Template tidak ditemukan!');
    }

    public function storeFromOrder($kode_transaksi)
    {
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();
        
        // Cek apakah status sudah 'paid'
        if ($order->status !== 'paid') {
            return back()->with('error', 'Order belum berstatus paid.');
        }

        // Simpan ke tabel weddings
        Wedding::create([
            'user_id' => $order->user_id,
            'slug' => Str::slug($order->bride_name . '-' . $order->groom_name . '-' . now()->timestamp),
            'bride_name' => $order->bride_name,
            'groom_name' => $order->groom_name,
            'bride_parents_info' => $order->bride_parents_info,
            'groom_parents_info' => $order->groom_parents_info,
            'akad_date' => $order->akad_date,
            'reception_date' => $order->reception_date,
            'location' => $order->location,
            'place_name' => $order->place_name,
            'description' => $order->description ?? null,
            'template_id' => $order->template_id,
            'music_id' => $order->music_id,
            'order_id' => $order->id,
        ]);

        // Update status order menjadi processed
        $order->update([
            'status' => 'processed',
        ]);

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Pesanan berhasil diproseskan ke data undangan.'
        ]);

        return redirect()->route('weddings.index');
    }

}
