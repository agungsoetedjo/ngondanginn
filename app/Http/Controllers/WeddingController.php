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
        return view('backend.weddings.create', compact('templates', 'musics'));
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
            'kode_transaksi' => $kodeTransaksi,
            'nama_pemesan' => $request->nama_pemesan,
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
        $wedding = Wedding::with(['order', 'template', 'music'])
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
            'template_id' => 'nullable|exists:templates,id', // Validasi template_id
            'music_id' => 'nullable|exists:musics,id',
        ]);
    
        // Membuat slug baru jika ada perubahan pada nama mempelai
        $slug = Str::slug($request->bride_name . '-' . $request->groom_name . '-' . now()->timestamp);
    
        // Siapkan data untuk update wedding
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
    
        // Cek status pembayaran di tabel order
        if ($wedding->order_id) {
            $order = Order::find($wedding->order_id);
    
            if ($order) {
                // Jika status order adalah pending, izinkan update template_id
                if ($order->status === 'pending') {
                    if ($request->filled('template_id')) {
                        $weddingData['template_id'] = $request->template_id;
                
                        // Ambil harga template baru
                        $template = Template::find($request->template_id);
                        if ($template) {
                            $order->payment_total = $template->price;
                            $order->save();
                        }
                    }
                }
            }
        }
    
        // Update data wedding
        $wedding->update($weddingData);
    
        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Undangan berhasil diupdate!'
        ]);
    
        return redirect()->route('weddings.index');
    }

    public function destroy($id)
    {
        // Temukan wedding yang dimiliki oleh user yang sedang login
        $wedding = Wedding::where('user_id', Auth::id())
                          ->where('id', $id)
                          ->firstOrFail();
    
        // Jika wedding memiliki order terkait, hapus order juga (optional)
        if ($wedding->order_id) {
            $order = Order::find($wedding->order_id);
            if ($order) {
                $order->delete();
            }
        }
    
        // Hapus wedding
        $wedding->delete();
    
        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Undangan dan data terkait berhasil dihapus!'
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

    public function processWedding($kode_transaksi)
    {
        // Temukan order berdasarkan kode transaksi
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();
        
        // Cek apakah status sudah 'paid'
        if ($order->status !== 'paid') {
            return back()->with('error', 'Order belum berstatus paid.');
        }
    
        // Update status order menjadi processed
        $order->update([
            'status' => 'processed',
        ]);
    
        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Pesanan berhasil diproses.'
        ]);
    
        return redirect()->route('admin.orders.show', $order->kode_transaksi);
    }

    public function publishWedding($kode_transaksi){
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();
        
        // Cek apakah status sudah 'paid'
        if ($order->status !== 'processed') {
            return back()->with('error', 'Order belum berstatus processed.');
        }

        $order->update([
            'status' => 'published',
        ]);

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Undangan berhasil dipublikasikan.'
        ]);

        return redirect()->route('admin.orders.show', $order->kode_transaksi);
    }

    public function completeWedding($kode_transaksi){
        $order = Order::where('kode_transaksi', $kode_transaksi)->firstOrFail();
        
        // Cek apakah status sudah 'paid'
        if ($order->status !== 'published') {
            return back()->with('error', 'Order belum berstatus published.');
        }

        $order->update([
            'status' => 'completed',
        ]);

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Undangan berhasil diselesaikan.'
        ]);

        return redirect()->route('admin.orders.show', $order->kode_transaksi);
    }

}
