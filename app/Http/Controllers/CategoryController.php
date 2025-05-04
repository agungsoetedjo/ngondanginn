<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('categories.create');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:dengan_foto,tanpa_foto',
        ]);
    
        // Tentukan nama folder berdasarkan kategori dan tipe
        $folderName = strtolower(str_replace(' ', '_', $validated['name'])) . '_' . $validated['type'];
    
        // Tentukan path folder di dalam resources/views/backend/template_packs
        $path = resource_path('views/backend/template_packs/' . $folderName);
    
        // Jika folder sudah ada, batalkan proses dan tampilkan pesan error
        if (file_exists($path)) {
            session()->flash('sweetalert', [
                'type' => 'error',
                'message' => 'Folder sudah ada. Silakan gunakan nama kategori dan tipe yang berbeda.',
            ]);
            return back()->withInput();
        }
    
        // Simpan kategori ke database
        Category::create($validated);
    
        // Buat folder karena belum ada
        mkdir($path, 0777, true);
    
        // Flash message untuk sukses
        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Kategori berhasil ditambahkan dan folder telah dibuat!',
        ]);
    
        return redirect()->route('categories.index');
    }
    
    

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(Category $category)
    // {
    //     return view('categories.edit', compact('category'));
    // }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:dengan_foto,tanpa_foto',
        ]);
    
        // Simpan nilai lama sebelum update
        $oldFolderName = strtolower(str_replace(' ', '_', $category->getOriginal('name'))) . '_' . $category->getOriginal('type');
        $oldPath = resource_path('views/backend/template_packs/' . $oldFolderName);
    
        // Update data kategori di DB
        $category->update($validated);
    
        // Nama folder baru setelah update
        $newFolderName = strtolower(str_replace(' ', '_', $category->name)) . '_' . $category->type;
        $newPath = resource_path('views/backend/template_packs/' . $newFolderName);
    
        // Jika nama folder berubah dan folder lama ada, rename ke folder baru
        if ($oldFolderName !== $newFolderName) {
            if (file_exists($oldPath)) {
                rename($oldPath, $newPath);
            } elseif (!file_exists($newPath)) {
                // Jika folder lama tidak ada, tapi folder baru juga belum dibuat
                mkdir($newPath, 0777, true);
            }
        } elseif (!file_exists($newPath)) {
            // Jika folder belum ada (awal tidak punya folder)
            mkdir($newPath, 0777, true);
        }
    
        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Kategori berhasil diperbarui dan folder sudah disesuaikan.'
        ]);
    
        return redirect()->route('categories.index');
    }    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // Dapatkan nama folder berdasarkan nama dan tipe kategori
        $folderName = strtolower(str_replace(' ', '_', $category->name)) . '_' . $category->type;
        $folderPath = resource_path('views/backend/template_packs/' . $folderName);
    
        // Hapus kategori dari database
        $category->delete();
    
        // Hapus folder jika ada dan kosong
        if (is_dir($folderPath)) {
            // Cek apakah folder kosong sebelum dihapus
            if (count(scandir($folderPath)) <= 2) {
                // Folder hanya berisi '.' dan '..'
                rmdir($folderPath);
            } else {
                // Jika tidak kosong, bisa pakai recursive delete jika diinginkan
                File::deleteDirectory($folderPath); // <- Opsional jika ingin hapus seluruh isi
            }
        }
    
        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Kategori berhasil dihapus!'
        ]);
    
        return redirect()->route('categories.index');
    }    
}
