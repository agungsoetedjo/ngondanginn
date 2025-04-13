<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class DesignController extends Controller
{
    public function index()
    {
        $wedding = Wedding::where('user_id', Auth::id())->first();

        // Ambil template terkait jika ada
        $template = null;
        if ($wedding && $wedding->template_id) {
            $template = Template::find($wedding->template_id);
        }

        $templates = Template::all();

        return view('backend.designs.index', compact('templates', 'wedding', 'template'));
    }

    public function create()
    {
        return view('backend.designs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'preview_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'view_path' => 'required|string|unique:templates,view_path',
            'price' => 'required|numeric|min:0', // tambahkan validasi harga
        ]);
    
        $file = $request->file('preview_image');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/templates'), $filename);
    
        Template::create([
            'name' => $request->name,
            'preview_image' => $filename,
            'view_path' => $request->view_path,
            'price' => $request->price, // simpan harga template
        ]);
    
        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Template berhasil ditambahkan!'
        ]);

        return redirect()->route('designs.index');
    }    

    public function update(Request $request, $id)
    {
        $template = Template::findOrFail($id);
    
        $request->validate([
            'name' => 'required|string|max:100',
            'preview_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'view_path' => 'required|string',
            'price' => 'required|numeric|min:0', // validasi harga
        ]);
    
        $template->name = $request->name;
        $template->view_path = $request->view_path;
        $template->price = $request->price; // update harga
    
        if ($request->hasFile('preview_image')) {
            if ($template->preview_image) {
                $oldImagePath = public_path('images/templates/' . $template->preview_image);
                if (File::exists($oldImagePath)) {
                    File::delete($oldImagePath);
                }
            }
    
            $file = $request->file('preview_image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/templates'), $filename);
            $template->preview_image = $filename;
        }
    
        $template->save();
    
        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Template berhasil diupdate!'
        ]);

        return redirect()->route('designs.index');
    }    

    public function edit($id)
    {
        // Ambil data template berdasarkan ID
        $template = Template::findOrFail($id);

        return view('backend.designs.edit', compact('template'));
    }

    public function destroy($id)
    {
        $template = Template::findOrFail($id);

        $imagePath = public_path('images/templates/' . $template->preview_image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $template->delete();

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Template berhasil dihapus!'
        ]);

        return redirect()->route('designs.index');
    }

    public function preview($templateId)
    {
        // Mencari template berdasarkan ID dan menangani jika template tidak ditemukan
        $template = Template::findOrFail($templateId);
    
        // Cek apakah file blade view-nya tersedia
        $viewPath = 'backend.' . $template->view_path;
        if (!view()->exists($viewPath)) {
            abort(404, 'Template view not found.');
        }
    
        // Mengirim data ke view
        return view($viewPath, [
            'template' => $template,
            'wedding' => (object)[
                'bride_name' => 'Anna',
                'groom_name' => 'Budi',
                'wedding_date' => now()->addDays(30),
                'location' => 'Jl. Kenangan No.1, Jakarta',
                'slug' => 'anna-budi',
                'template_id' => $template->id,
            ],
            'rsvps' => collect([]),
            'guestBooks' => collect([]),
            'galleries' => collect([]),
            'music' => null,
        ]);
    }




}
