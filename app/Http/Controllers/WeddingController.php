<?php

namespace App\Http\Controllers;

use App\Mail\OrderEInvoiceMail;
use App\Models\Music;
use App\Models\Order;
use App\Models\RSVP;
use App\Models\Template;
use App\Models\Wedding;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class WeddingController extends Controller
{

    public function index()
    {
        $weddings = Wedding::with('order')
        ->where('user_id', Auth::id())
        ->whereHas('order', function ($query) {
            $query->where('status', '!=', 'completed');
        })
        ->latest()
        ->get();
    
        return view('backend.weddings.index', compact('weddings'));
    }

    public function create()
    {
        $musics = Music::all();
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
            'akad_location' => 'required|string|max:255',
            'akad_place_name' => 'nullable|string|max:255',
            'reception_location' => 'required|string|max:255',
            'reception_place_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'phone_number' => 'required|string|max:20',
            'template_id' => 'required|exists:templates,id',
            'music_id' => 'nullable|exists:musics,id',
        ]);

        $kodeTransaksi = 'WD_ORDER_' . Str::upper(uniqid());

        // Buat order terlebih dahulu
        $order = Order::create([
            'kode_transaksi' => $kodeTransaksi,
            'nama_pemesan' => $request->nama_pemesan,
            'phone_number' => $request->phone_number,
            'status' => 'created',
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
            'akad_location' => $request->location,
            'akad_place_name' => $request->place_name,
            'reception_location' => $request->location,
            'reception_place_name' => $request->place_name,
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
            'akad_location' => 'required|string|max:255',
            'akad_place_name' => 'nullable|string|max:255',
            'reception_location' => 'required|string|max:255',
            'reception_place_name' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'template_id' => 'nullable|exists:templates,id', // Validasi template_id
            'music_id' => 'nullable|exists:musics,id',
        ]);
    
        // Membuat slug baru jika ada perubahan pada nama mempelai
        $slug = Str::slug($request->groom_name . '-' . $request->bride_name . '-' . Str::random(5));
    
        // Siapkan data untuk update wedding
        $weddingData = [
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'bride_parents_info' => $request->bride_parents_info,
            'groom_parents_info' => $request->groom_parents_info,
            'akad_date' => $request->akad_date ? Carbon::parse($request->akad_date) : null,
            'reception_date' => $request->reception_date ? Carbon::parse($request->reception_date) : null,
            'akad_location' => $request->akad_location,
            'akad_place_name' => $request->akad_place_name,
            'reception_location' => $request->reception_location,
            'reception_place_name' => $request->reception_place_name,
            'description' => $request->description,
            'music_id' => $request->music_id,
            'slug' => $slug,
        ];
    
        // Cek status pembayaran di tabel order
        if ($wedding->order_id) {
            $order = Order::find($wedding->order_id);
    
            if ($order) {
                // Jika status pembayaran adalah pending, izinkan update template_id
                if ($order->payment->payment_status === 'pending') {
                    if ($request->filled('template_id')) {
                        $weddingData['template_id'] = $request->template_id;
                
                        // Ambil harga template baru
                        $template = Template::find($request->template_id);
                        if ($template) {
                            $order->payment->payment_total = $template->price;
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
        $wedding = Wedding::with('galleries')->where('user_id', Auth::id())->where('id', $id)->firstOrFail();
    
        if ($wedding->galleries) {
            foreach ($wedding->galleries as $gallery) {
                $filePathGaleri = public_path('/'.$gallery->image); // Pastikan path benar
                if (file_exists($filePathGaleri)) {
                    unlink($filePathGaleri); // Hapus file bukti transfer
                }
            }
        }

        // Jika wedding memiliki order terkait, hapus order juga (optional)
        if ($wedding->order_id) {
            $order = Order::find($wedding->order_id);
            if ($order) {
                // Hapus file payment_proof dari folder public jika ada
                if ($order->payment->payment_proof) {
                    $filePath = public_path($order->payment->payment_proof);
                    if (file_exists($filePath)) {
                        unlink($filePath); // Hapus file bukti transfer
                    }
                }
    
                // Hapus order
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

    public function processWedding($kode_transaksi)
    {
        // Temukan order berdasarkan kode transaksi
        $order = Order::with('wedding')->where('kode_transaksi', $kode_transaksi)->firstOrFail();
        
        // Cek apakah status sudah 'paid'
        if ($order->payment->payment_status !== 'paid') {
            return back()->with('error', 'Pesanan belum berstatus Pembayaran Diterima.');
        }
    
        // Update status order menjadi processed
        $order->update([
            'status' => 'processed',
        ]);

        Mail::to($order->email_pemesan)->send(new OrderEInvoiceMail($order));

        $message = "Hai, *{$order->wedding->groom_name} & {$order->wedding->bride_name}*!\n\n" .
            "Pesanan undangan digitalmu dengan kode *#{$order->kode_transaksi}* sudah berhasil diproses oleh tim kami.\n\n" .
            "Tunggu notifikasi selanjutnya ketika undanganmu siap untuk dipublikasikan ya!.\n\n Terimakasih.";

        sendWhatsAppNotification($order->phone_number, $message);
        
        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Pesanan berhasil diproses.'
        ]);
    
        return redirect()->route('orders.index', $order->kode_transaksi);
    }

    public function publishWedding($kode_transaksi)
    {
        $order = Order::with('wedding')->where('kode_transaksi', $kode_transaksi)->firstOrFail();
    
        if ($order->status !== 'processed') {
            return back()->with('error', 'Pesanan belum berstatus Diproses.');
        }
    
        $order->update([
            'status' => 'published',
        ]);
    
        Mail::to($order->email_pemesan)->send(new OrderEInvoiceMail($order));
    
        $message = "Hai, *{$order->wedding->groom_name} & {$order->wedding->bride_name}*!\n\n" .
            "Undangan digitalmu dengan kode *#{$order->kode_transaksi}* telah berhasil dipublikasikan.\n\n" .
            "Silakan akses undanganmu di:\n\n" .
            route('wedding.checks', $order->wedding->slug) . "\n\n" .
            "Selamat menanti hari bahagia! 💍";
    
        sendWhatsAppNotification($order->phone_number, $message);
    
        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Undangan berhasil dipublikasikan.'
        ]);
    
        return redirect()->route('orders.index', $order->kode_transaksi);
    }
    

    public function completeWedding($kode_transaksi){
        $order = Order::with('wedding')->where('kode_transaksi', $kode_transaksi)->firstOrFail();
        
        // Cek apakah status sudah 'paid'
        if ($order->status !== 'published') {
            return back()->with('error', 'Pesanan belum berstatus Dipublikasi.');
        }

        $order->update([
            'status' => 'completed',
        ]);

        Mail::to($order->email_pemesan)->send(new OrderEInvoiceMail($order));

        $message = "Hai, *{$order->wedding->groom_name} & {$order->wedding->bride_name}*!\n\n" .
        "Selamat! Undangan digital pernikahanmu dengan kode transaksi *#{$order->kode_transaksi}* sudah selesai sepenuhnya.\n\n" .
        "Terima kasih telah menggunakan layanan Ngondang.in.\n\n" .
        "Semoga hari bahagiamu berjalan lancar dan penuh kebahagiaan.\n\n" .
        "Salam hangat dari kami di Ngondang.in 💖";
    
        sendWhatsAppNotification($order->phone_number, $message);
        
        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Undangan berhasil diselesaikan.'
        ]);

        return redirect()->route('index-archive', $order->kode_transaksi);
    }

    public function updateMusic(Request $request, $id)
    {
        $request->validate([
            'music_id' => 'required|exists:musics,id',
        ]);

        $wedding = Wedding::findOrFail($id);

        // pastikan user yang mengelola undangan ini adalah user yang sedang login
        if ($wedding->user_id !== Auth::id()) {
            abort(403);
        }

        $wedding->music_id = $request->music_id;
        $wedding->save();

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Musik latar berhasil diperbarui!'
        ]);

        return back();
    }

    public function weddingChecks($slug)
    {
        // Ambil data wedding beserta relasi order
        $wedding = Wedding::with(['order', 'template.category', 'music', 'galleries'])->where('slug', $slug)->firstOrFail();

        $cover = $wedding->galleries->where('image_desc', 1)->first();
        $groomPhoto = $wedding->galleries->where('image_desc', 2)->first();
        $bridePhoto = $wedding->galleries->where('image_desc', 3)->first();
        $galleryPhotos = $wedding->galleries->where('image_desc', 0);

        $attendingCount = RSVP::where('wedding_id', $wedding->id)
        ->where('attendance', 'yes')
        ->count();

        $notAttendingCount = RSVP::where('wedding_id', $wedding->id)
        ->where('attendance', 'no')
        ->count();
        
        // Ambil view_path dari template
        $viewPath = 'backend.' . $wedding->template->view_path;
        // Cek status order untuk memastikan akses
        if (!in_array($wedding->order->status, ['processed', 'published'])) {
            abort(403, 'Undangan Tidak Dapat Diakses.');
        }
    
        // Render view dengan nama yang ada di viewPath
        return view($viewPath, compact('wedding','attendingCount','notAttendingCount','cover', 'groomPhoto', 'bridePhoto', 'galleryPhotos'));
    }
}