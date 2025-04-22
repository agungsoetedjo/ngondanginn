<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MusicController extends Controller
{
    public function index()
    {
        $musics = Music::latest()->get();
        return view('backend.musics.index', compact('musics'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'artist' => 'required|string|max:255', // Validasi untuk artist
                'file' => 'required|mimes:mp3|max:10240', // Validasi file mp3 dengan ukuran maksimal 10MB
            ]);
    
            // Upload file musik
            $file = $request->file('file');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $filePath = 'uploads/musik/' . $filename;
            $file->move(public_path('uploads/musik'), $filename);
    
            // Simpan data musik ke database
            Music::create([
                'title' => $request->title,
                'artist' => $request->artist, // Menyimpan artist
                'file_path' => $filePath,
            ]);
    
            // Mengirim notifikasi SweetAlert
            return redirect()->back()->with('sweetalert', [
                'type' => 'success',
                'message' => 'Musik berhasil diunggah!'
            ]);
            
        } catch (ValidationException $e) {
            return back()->with('sweetalert', [
                'type' => 'warning',
                'message' => $e->validator->errors()->first()
            ])->withInput();
        } catch (\Exception $e) {
            return back()->with('sweetalert', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengunggah musik. Silakan coba lagi.'
            ])->withInput();
        }
    }
    
    public function destroy($id)
    {
        $music = Music::findOrFail($id);

        $filePath = public_path($music->file_path);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $music->delete();

        return redirect()->back()->with('sweetalert', [
            'type' => 'success',
            'message' => 'Musik berhasil dihapus!'
        ]);
    }
}
