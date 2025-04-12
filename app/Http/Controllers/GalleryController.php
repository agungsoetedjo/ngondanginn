<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index($weddingId)
    {
        $wedding = Wedding::where('user_id', Auth::id())->findOrFail($weddingId);
        $images = $wedding->galleries()->latest()->get();

        return view('backend.galleries.index', compact('wedding', 'images'));
    }

    public function store(Request $request, Wedding $wedding)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('image');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $path = 'uploads/galeri/' . $filename;
        $file->move(public_path('uploads/galeri'), $filename);

        $wedding->galleries()->create([
            'image' => $path
        ]);

        return redirect()->back()->with('success', 'Foto berhasil diunggah!');
    }


    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Hapus file fisik
        $filePath = public_path($gallery->image);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $gallery->delete();

        return redirect()->back()->with('success', 'Foto berhasil dihapus!');
    }

}
