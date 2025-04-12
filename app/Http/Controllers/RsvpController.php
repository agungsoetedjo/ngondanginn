<?php

namespace App\Http\Controllers;

use App\Models\Rsvp;
use App\Models\Wedding;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RsvpController extends Controller
{
    public function index($id)
    {
        $wedding = Wedding::where('user_id', Auth::id())->findOrFail($id);
        $rsvps = $wedding->rsvps()->latest()->get();

        return view('backend.rsvp.index', compact('wedding', 'rsvps'));
    }

    public function destroy($id)
    {
        $rsvp = Rsvp::findOrFail($id);
        $wedding = $rsvp->wedding;

        if ($wedding->user_id !== Auth::id()) {
            abort(403);
        }

        $rsvp->delete();
        return back()->with('success', 'Data RSVP dihapus.');
    }
}
