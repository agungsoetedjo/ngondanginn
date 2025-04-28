<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

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
        try {
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
                return back()->with('sweetalert', [
                    'type' => 'error',
                    'message' => 'Template dasar tidak ditemukan.'
                ]);
            }
    
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
    
        } catch (ValidationException $e) {
            return back()->with('sweetalert', [
                'type' => 'warning',
                'message' => $e->validator->errors()->first()
            ])->withInput();
        } catch (\Exception $e) {
            return back()->with('sweetalert', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat menyimpan template: ' . $e->getMessage()
            ])->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        try {
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
    
            // Update data template
            $template->name = $request->name;
            $template->view_path = $request->view_path;
            $template->price = $request->price;
    
            // Update preview image jika ada
            if ($request->hasFile('preview_image')) {
                // Hapus gambar lama
                if ($template->preview_image) {
                    $oldImagePath = public_path('images/templates/' . $template->preview_image);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }
    
                // Upload gambar baru
                $file = $request->file('preview_image');
                $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/templates'), $filename);
                $template->preview_image = $filename;
            }
    
            // Simpan perubahan ke database
            $template->save();
    
            return redirect()->route('designs.index')->with('sweetalert', [
                'type' => 'success',
                'message' => 'Template berhasil diupdate!'
            ]);
    
        } catch (ValidationException $e) {
            return back()->with('sweetalert', [
                'type' => 'warning',
                'message' => $e->validator->errors()->first()
            ])->withInput();
        } catch (\Exception $e) {
            return back()->with('sweetalert', [
                'type' => 'error',
                'message' => 'Terjadi kesalahan saat mengupdate template. Silakan coba lagi.'
            ])->withInput();
        }
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
                'groom_name' => 'Habib',
                'bride_name' => 'Adiba',
                'groom_parents_info' => 'Putra pertama dari Bpk Wawan & Ibu Indah',
                'bride_parents_info' => 'Putri pertama dari Bpk Habibie & Ibu Ainun',
                'akad_date' => '2025-05-20 09:00:00',
                'reception_date' => '2025-05-20 11:00:00',
                'akad_place_name' => 'Gedung Serbaguna Graha Citra',
                'akad_location' => 'Jl. Raya Sudirman No. 123, Jakarta Selatan',
                'reception_place_name' => 'Gedung Serbaguna Graha Citra',
                'reception_location' => 'Jl. Raya Sudirman No. 123, Jakarta Selatan',
                'description' => 'asdasdasdasdasd',
                'slug' => 'anna-budi',
                'template_id' => $template->id,
                'rsvps' => [],
                'guestBooks' => [],
                'galleries' => [
                    (object)['image' => 'assets/img/portfolio/app-1.jpg'],
                ],
                'music' => (object)['file_path' => ''],
            ],
            'attendingCount' => '0',
            'notAttendingCount' => '0',
            'cover' => (object)[
                'image' => 'assets_be/img/cover.jpg',
            ],
            'groomPhoto' => (object)[
                'image' => 'assets_be/img/groom.jpg',
            ],
            'bridePhoto' => (object)[
                'image' => 'assets_be/img/bride.jpg',
            ],
            'galleryPhotos' => collect([
                (object)['image' => 'assets_be/img/gallery.jpg'],
            ]),
        ]);        
    }
}
