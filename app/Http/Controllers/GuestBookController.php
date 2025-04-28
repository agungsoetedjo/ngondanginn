<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuestBookController extends Controller
{
    public function index($id)
    {
        $wedding = Wedding::where('user_id', Auth::id())->findOrFail($id);
        $guests = $wedding->guestBooks()->latest()->get();

        return view('backend.guestbooks.index', compact('wedding', 'guests'));
    }

    public function destroy($id)
    {
        $guest = GuestBook::findOrFail($id);
        $wedding = $guest->wedding;

        if ($wedding->user_id !== Auth::id()) {
            abort(403);
        }

        $guest->delete();

        session()->flash('sweetalert', [
            'type' => 'success',
            'message' => 'Pesan buku tamu dihapus.'
        ]);

        return back();
    }
}
