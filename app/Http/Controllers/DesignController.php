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
        ]);

        $file = $request->file('preview_image');
        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images/templates'), $filename);

        Template::create([
            'name' => $request->name,
            'preview_image' => $filename,
            'view_path' => $request->view_path,
        ]);

        return redirect()->route('designs.index')->with('success', 'Template berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $wedding = Wedding::with('template')->findOrFail($id);
        $templates = Template::all();

        return view('designs.edit', compact('wedding', 'templates'));
    }

    public function update(Request $request, $id)
    {
        $template = Template::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100',
            'preview_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'view_path' => 'required|string|unique:templates,view_path,' . $id,
        ]);

        $data = [
            'name' => $request->name,
            'view_path' => $request->view_path,
        ];

        if ($request->hasFile('preview_image')) {
            // Hapus gambar lama jika ada
            $oldPath = public_path('images/templates/' . $template->preview_image);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }

            $file = $request->file('preview_image');
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/templates'), $filename);
            $data['preview_image'] = $filename;
        }

        $template->update($data);

        return redirect()->route('designs.index')->with('success', 'Template berhasil diupdate.');
    }

    public function destroy($id)
    {
        $template = Template::findOrFail($id);

        $imagePath = public_path('images/templates/' . $template->preview_image);
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $template->delete();

        return redirect()->route('designs.index')->with('success', 'Template berhasil dihapus.');
    }
}
