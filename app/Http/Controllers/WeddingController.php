<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WeddingController extends Controller
{
    public function index()
    {
        $weddings = Wedding::where('user_id', Auth::id())->latest()->get();
        return view('backend.weddings.index', compact('weddings'));
    }

    public function create()
    {
        return view('backend.weddings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bride_name' => 'required|string|max:100',
            'groom_name' => 'required|string|max:100',
            'wedding_date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Wedding::create([
            'user_id' => Auth::id(),
            'slug' => Str::slug($request->bride_name . '-' . $request->groom_name . '-' . now()->timestamp),
            'bride_name' => $request->bride_name,
            'groom_name' => $request->groom_name,
            'wedding_date' => $request->wedding_date,
            'location' => $request->location,
            'description' => $request->description,
        ]);

        return redirect()->route('weddings.index')->with('success', 'Undangan berhasil dibuat.');
    }

    public function edit($slug)
    {
        $wedding = Wedding::where('user_id', Auth::id())
                      ->where('slug', $slug)
                      ->firstOrFail();
        return view('backend.weddings.edit', compact('wedding'));
    }

    public function update(Request $request, $id)
    {
        $wedding = Wedding::where('user_id', Auth::id())->findOrFail($id);

        $request->validate([
            'bride_name' => 'required|string|max:100',
            'groom_name' => 'required|string|max:100',
            'wedding_date' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $wedding->update($request->only([
            'bride_name', 'groom_name', 'wedding_date', 'location', 'description'
        ]));

        return redirect()->route('weddings.index')->with('success', 'Undangan berhasil diupdate.');
    }

    public function destroy($slug)
    {
        $wedding = Wedding::where('user_id', Auth::id())
                      ->where('slug', $slug)
                      ->firstOrFail();
        $wedding->delete();

        return redirect()->route('weddings.index')->with('success', 'Undangan berhasil dihapus.');
    }
}
