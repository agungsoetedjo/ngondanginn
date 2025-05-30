<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class GalleryController extends Controller
{
    public function index($weddingId)
    {
        $wedding = Wedding::where('user_id', Auth::id())->findOrFail($weddingId);
    
        if ($wedding->template->category->type === 'tanpa_foto') {
            return back()->with('sweetalert', [
                'type' => 'warning',
                'message' => 'Template di undangan ini tidak mendukung galeri foto.'
            ]);
        }
    
        $images = $wedding->galleries()->latest()->get();
    
        return view('backend.galleries.index', compact('wedding', 'images'));
    }    

    public function store(Request $request, $id)
    {
        $wedding = Wedding::where('user_id', Auth::id())->findOrFail($id);

        try {
            $request->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'image_desc' => 'required|in:0,1,2,3'
            ]);

            $file = $request->file('image');
            $filename = uniqid() . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/galeri/' . $filename;
            $file->move(public_path('uploads/galeri'), $filename);

            if (in_array($request->image_desc, ['1', '2', '3'])) {
                $existing = $wedding->galleries()->where('image_desc', $request->image_desc)->first();
                if ($existing) {
                    $oldPath = public_path($existing->image);
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }

                    $existing->update([
                        'image' => $path,
                        'image_desc' => $request->image_desc,
                    ]);

                    session()->flash('sweetalert', [
                        'type' => 'success',
                        'message' => 'Foto berhasil diperbarui!'
                    ]);
                } else {
                    $wedding->galleries()->create([
                        'image' => $path,
                        'image_desc' => $request->image_desc,
                    ]);

                    session()->flash('sweetalert', [
                        'type' => 'success',
                        'message' => 'Foto berhasil ditambahkan!'
                    ]);
                }
            } else {
                $wedding->galleries()->create([
                    'image' => $path,
                    'image_desc' => $request->image_desc,
                ]);

                session()->flash('sweetalert', [
                    'type' => 'success',
                    'message' => 'Foto galeri berhasil ditambahkan!'
                ]);
            }

        } catch (ValidationException $e) {
            session()->flash('sweetalert', [
                'type' => 'warning',
                'message' => $e->validator->errors()->first()
            ]);
        }

        return back()->withInput();
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

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Foto berhasil dihapus!'
        ]);

        return back();
    }
}