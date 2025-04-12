<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use App\Models\Template;
use App\Models\Music;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DesignController extends Controller
{
    public function edit($weddingId)
    {
        $wedding = Wedding::where('user_id', Auth::id())->findOrFail($weddingId);
        $templates = Template::all();
        $musics = Music::all();

        return view('backend.designs.edit', compact('wedding', 'templates', 'musics'));
    }

    public function update(Request $request, $weddingId)
    {
        $wedding = Wedding::where('user_id', Auth::id())->findOrFail($weddingId);

        $request->validate([
            'template_id' => 'nullable|exists:templates,id',
            'music_id' => 'nullable|exists:musics,id',
        ]);

        $wedding->update([
            'template_id' => $request->template_id,
            'music_id' => $request->music_id,
        ]);

        return back()->with('success', 'Desain & musik diperbarui.');
    }
}
