<?php

namespace App\Http\Controllers;

use App\Models\Music;
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
        $weddings = Wedding::where('user_id', Auth::id())->latest()->get();
        return view('backend.weddings.index', compact('weddings'));
    }

    public function create()
    {
        $musics = Music::all();  // Bisa ditambahin filter jika perlu
        $templates = Template::all();
        return view('backend.weddings.create', compact('templates','musics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bride_name' => 'required|string|max:255',
            'groom_name' => 'required|string|max:255',
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

        Wedding::create([
            'user_id' => Auth::id(),
            'slug' => Str::slug($request->bride_name . '-' . $request->groom_name . '-' . now()->timestamp),
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'bride_parents_info' => $request->bride_parents_info,
            'groom_parents_info' => $request->groom_parents_info,
            'akad_date' => $request->akad_date ? Carbon::parse($request->akad_date) : null,  // Memastikan format tanggal
            'reception_date' => $request->reception_date ? Carbon::parse($request->reception_date) : null,  // Memastikan format tanggal
            'location' => $request->location,
            'place_name' => $request->place_name,
            'description' => $request->description,
            'template_id' => $request->template_id,
            'music_id' => $request->music_id,
        ]);

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Undangan berhasil dibuat!'
        ]);

        return redirect()->route('weddings.index');
    }

    public function edit($slug)
    {
        $musics = Music::all();
        $templates = Template::all();
        $wedding = Wedding::where('user_id', Auth::id())
                        ->where('slug', $slug)
                        ->firstOrFail();
        
        // Format wedding_date agar sesuai dengan format datetime-local
        $wedding_date = optional($wedding->wedding_date)->format('Y-m-d\TH:i') ?? '';
        
        return view('backend.weddings.edit', compact('wedding', 'templates','musics', 'wedding_date'));
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

        // Cek apakah nama mempelai wanita atau pria berubah
        $slug = Str::slug($request->bride_name . '-' . $request->groom_name . '-' . now()->timestamp);

        $wedding->update([
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'bride_parents_info' => $request->bride_parents_info,
            'groom_parents_info' => $request->groom_parents_info,
            'akad_date' => $request->akad_date ? Carbon::parse($request->akad_date) : null,  // Memastikan format tanggal
            'reception_date' => $request->reception_date ? Carbon::parse($request->reception_date) : null,  // Memastikan format tanggal
            'location' => $request->location,
            'place_name' => $request->place_name,
            'description' => $request->description,
            'template_id' => $request->template_id,
            'music_id' => $request->music_id,
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
