<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WeddingController extends Controller
{
    public function index()
    {
        $weddings = Wedding::where('user_id', Auth::id())->latest()->get();
        return view('backend.weddings.index', compact('weddings'));
    }

    public function create()
    {
        $templates = Template::all();
        return view('backend.weddings.create', compact('templates'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bride_name' => 'required|string|max:100',
            'groom_name' => 'required|string|max:100',
            'wedding_date' => 'required|date',  // Validasi untuk tanggal dan waktu
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'template_id' => 'required|exists:templates,id',
        ]);

        Wedding::create([
            'user_id' => Auth::id(),
            'slug' => Str::slug($request->bride_name . '-' . $request->groom_name . '-' . now()->timestamp),
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'wedding_date' => $request->wedding_date,  // Menyimpan tanggal dan waktu
            'location' => $request->location,
            'place_name' => $request->place_name,
            'description' => $request->description,
            'template_id' => $request->template_id,
        ]);

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Undangan berhasil dibuat!'
        ]);

        return redirect()->route('weddings.index');
    }

    public function edit($slug)
    {
        $templates = Template::all();
        $wedding = Wedding::where('user_id', Auth::id())
                        ->where('slug', $slug)
                        ->firstOrFail();
        
        // Format wedding_date agar sesuai dengan format datetime-local
        $wedding_date = $wedding->wedding_date->format('Y-m-d\TH:i');
        
        return view('backend.weddings.edit', compact('wedding', 'templates', 'wedding_date'));
    }

    public function update(Request $request, $slug)
    {
        // Cari pernikahan berdasarkan slug
        $wedding = Wedding::where('user_id', Auth::id())
                        ->where('slug', $slug)
                        ->firstOrFail();

        $request->validate([
            'bride_name' => 'required|string|max:100',
            'groom_name' => 'required|string|max:100',
            'wedding_date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
            'template_id' => 'required|exists:templates,id',
        ]);

        // Cek apakah nama mempelai wanita atau pria berubah
        $slug = Str::slug($request->bride_name . '-' . $request->groom_name . '-' . now()->timestamp);

        $wedding->update([
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'wedding_date' => $request->wedding_date,
            'location' => $request->location,
            'place_name' => $request->place_name,
            'description' => $request->description,
            'template_id' => $request->template_id,
            'slug' => $slug, // Update slug jika ada perubahan
        ]);

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Undangan berhasil diupdate!'
        ]);

        return redirect()->route('weddings.index');
    }

    public function destroy($slug)
    {
        $wedding = Wedding::where('user_id', Auth::id())
                      ->where('slug', $slug)
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
}
