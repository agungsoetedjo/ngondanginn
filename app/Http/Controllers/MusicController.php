<?php

namespace App\Http\Controllers;

use App\Models\Music;
use Illuminate\Http\Request;

class MusicController extends Controller
{
    public function index()
    {
        $musics = Music::latest()->get();
        return view('backend.musics.index', compact('musics'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:mp3|max:5120',
        ]);

        $file = $request->file('file');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $filePath = 'uploads/musik/' . $filename;
        $file->move(public_path('uploads/musik'), $filename);

        Music::create([
            'title' => $request->title,
            'file_path' => $filePath,
        ]);

        return redirect()->back()->with('success', 'Musik berhasil diunggah!');
    }

    public function destroy($id)
    {
        $music = Music::findOrFail($id);

        $filePath = public_path($music->file_path);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $music->delete();

        return redirect()->back()->with('success', 'Musik berhasil dihapus!');
    }

}
