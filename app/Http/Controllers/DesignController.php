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
            'price' => 'required|numeric|min:0',
        ]);

        // Upload preview image
        $file = $request->file('preview_image');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/templates'), $filename);

        // Buat file blade baru dari _newtemplate.blade.php
        $newViewPath = str_replace('.', '/', $request->view_path); // convert ke path folder
        $targetPath = resource_path("views/backend/{$newViewPath}.blade.php");
        $templateSource = resource_path("views/backend/template_packs/pre_design/_newtemplate.blade.php");

        if (!File::exists($templateSource)) {
            return back()->withErrors(['template' => 'Template dasar tidak ditemukan.']);
        }

        // Copy isi file template dasar ke file baru
        File::ensureDirectoryExists(dirname($targetPath));
        File::copy($templateSource, $targetPath);

        // Simpan ke database
        Template::create([
            'name' => $request->name,
            'preview_image' => $filename,
            'view_path' => $request->view_path,
            'price' => $request->price,
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
            'price' => 'required|numeric|min:0',
        ]);

        // Rename file blade jika view_path berubah
        if ($template->view_path !== $request->view_path) {
            $oldPath = resource_path('views/backend/' . str_replace('.', '/', $template->view_path) . '.blade.php');
            $newPath = resource_path('views/backend/' . str_replace('.', '/', $request->view_path) . '.blade.php');

            if (File::exists($oldPath)) {
                File::ensureDirectoryExists(dirname($newPath));
                File::move($oldPath, $newPath);
            }
        }

        // Update data
        $template->name = $request->name;
        $template->view_path = $request->view_path;
        $template->price = $request->price;

        // Update gambar jika ada
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
    
        // Hapus gambar preview
        $imagePath = public_path('images/templates/' . $template->preview_image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    
        // Hapus file blade berdasarkan view_path
        $bladePath = resource_path('views/backend/' . str_replace('.', '/', $template->view_path) . '.blade.php');
        if (File::exists($bladePath)) {
            File::delete($bladePath);
        }
    
        // Hapus dari database
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
                'bride_name' => 'Habib',
                'groom_name' => 'Adiba',
                'bride_parents_info' => 'Putra pertama dari Bpk Habibie & Ibu Ainun',
                'groom_parents_info' => 'Putri pertama dari Bpk Wawan & Ibu Indah',
                'akad_date' => '2025-05-20 09:00:00',
                'reception_date' => '2025-05-20 11:00:00',
                'place_name' => 'Gedung Serbaguna Graha Citra',
                'location' => 'Jl. Raya Sudirman No. 123, Jakarta Selatan',
                'description' => 'asdasdasdasdasd',
                'slug' => 'anna-budi',
                'template_id' => $template->id,
                'rsvps' => collect([]),
                'guestBooks' => collect([]),
                'galleries' => collect([
                    (object)['image' => 'assets/img/portfolio/app-1.jpg'],
                    (object)['image' => 'assets/img/portfolio/app-2.jpg'],
                    (object)['image' => 'assets/img/portfolio/app-3.jpg'],
                ]),
                'music' => (object)['file_path' => ''],
            ],
            'attendingCount' => '0',
            'notAttendingCount' => '0',
        ]);
    }




}
