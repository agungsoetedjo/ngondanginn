<?php

namespace App\Http\Controllers;

use App\Models\Category;
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

        $templates = Template::with('category')->get();

        return view('backend.templates.index', compact('templates', 'wedding', 'template'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('backend.templates.create', compact('categories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:100',
                'preview_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
                'view_path' => 'required|string|unique:templates,view_path',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
            ]);
    
            // Ambil kategori dari database
            $category = Category::findOrFail($request->category_id);
            $combinedCategoryType = strtolower(str_replace(' ', '_', $category->name)) . '_' . $category->type;
    
            // Tentukan file template sumber
            $templateType = str_contains($combinedCategoryType, 'tanpa_foto') 
                ? '_newtemplate_tanpafoto.blade.php' 
                : '_newtemplate_foto.blade.php';
    
            $templateSource = resource_path("views/backend/template_packs/{$templateType}");
    
            // Validasi template sumber
            if (!File::exists($templateSource)) {
                return back()->with('sweetalert', [
                    'type' => 'error',
                    'message' => 'Template dasar tidak ditemukan.'
                ]);
            }
    
            // Upload gambar preview
            $file = $request->file('preview_image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/templates'), $filename);
    
            // Buat folder & salin file blade
            $newViewPath = str_replace('.', '/', $request->view_path);
            $targetPath = resource_path("views/backend/{$newViewPath}.blade.php");
            File::ensureDirectoryExists(dirname($targetPath));
            File::copy($templateSource, $targetPath);
    
            // Simpan template ke database
            Template::create([
                'name' => $request->name,
                'preview_image' => $filename,
                'view_path' => $request->view_path,
                'price' => $request->price,
                'category_id' => $request->category_id,
            ]);
    
            session()->flash('sweetalert', [
                'type' => 'success',
                'message' => 'Template berhasil ditambahkan!'
            ]);
    
            return redirect()->route('templates.index');
    
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
                'category_id' => 'required|exists:categories,id',  // Pastikan category_id valid
                'preview_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
                'view_path' => 'required|string',
                'price' => 'required|numeric|min:0',
            ]);
    
            $oldViewPath = $template->view_path;
            $newViewPath = $request->view_path;
    
            // Tangani jika view_path berubah
            if ($oldViewPath !== $newViewPath) {
                $oldPath = resource_path('views/backend/' . str_replace('.', '/', $oldViewPath) . '.blade.php');
                $newPath = resource_path('views/backend/' . str_replace('.', '/', $newViewPath) . '.blade.php');
    
                if (File::exists($oldPath)) {
                    File::ensureDirectoryExists(dirname($newPath));
                    File::move($oldPath, $newPath);
    
                    // Jika folder lama kosong setelah pindah, bisa dihapus (opsional)
                    $oldDir = dirname($oldPath);
                    if (File::isDirectory($oldDir) && count(File::files($oldDir)) === 0 && $this->isEmptyCategoryFolder($oldDir)) {
                        File::deleteDirectory($oldDir);
                    }
                }
            }
    
            // Update data template
            $template->name = $request->name;
            $template->category_id = $request->category_id;  // Pastikan category_id terupdate
            $template->view_path = $newViewPath;
            $template->price = $request->price;
    
            // Gambar preview baru
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
    
            return redirect()->route('templates.index')->with('sweetalert', [
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
    
    private function isEmptyCategoryFolder($folderPath)
    {
        // Periksa apakah folder tersebut adalah folder kategori yang kosong
        $categoryFolder = dirname($folderPath); // Folder kategori sebelumnya
        return File::isDirectory($categoryFolder) && count(File::files($categoryFolder)) === 0;
    }    

    public function edit($id)
    {
        // Ambil data template berdasarkan ID
        $categories = Category::all();
        $template = Template::findOrFail($id);

        return view('backend.templates.edit', compact('categories','template'));
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
    
        return redirect()->route('templates.index');
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
                'groom_name' => 'Muchamad Rafi Subhi Fauzi, S.Kom.',
                'bride_name' => 'Yuni Widyaningsih',
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
                'template' => $template,
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
