<?php

namespace App\Http\Controllers;

use App\Models\GuestBook;
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
        session()->flash('success','Data RSVP berhasil dihapus');
        return redirect()->route('rsvps.index', $wedding->id);
    }

    public function store(Request $request, $slug)
    {
        // Validasi data
        $validated = $request->validate([
            'nama_tamu' => 'required|string|max:255',
            'ucapan' => 'required|string',
            'kehadiran' => 'required|in:yes,no',
            'alasan' => 'nullable|string|required_if:kehadiran,no',
        ]);

        try {
            // Cari wedding berdasarkan slug
            $wedding = Wedding::where('slug', $slug)->firstOrFail();

            // Simpan ke guest_books
            GuestBook::create([
                'wedding_id' => $wedding->id,
                'name' => $validated['nama_tamu'],
                'message' => $validated['ucapan'],
            ]);

            // Simpan ke rsvps
            Rsvp::create([
                'wedding_id' => $wedding->id,
                'name' => $validated['nama_tamu'],
                'attendance' => $validated['kehadiran'],
                'reason' => $validated['kehadiran'] === 'no' ? $validated['alasan'] : null,
            ]);

            $attendingCount = Rsvp::where('wedding_id', $wedding->id)->where('attendance', 'yes')->count();
            $notAttendingCount = Rsvp::where('wedding_id', $wedding->id)->where('attendance', 'no')->count();

            // Return success response
            return response()->json([
                'success' => true,
                'message' => 'RSVP berhasil terkirim!',
                'attending_count' => $attendingCount,
                'not_attending_count' => $notAttendingCount
            ]);
        } catch (\Exception $e) {
            // Jika terjadi kesalahan, kirimkan respons error
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan. Silakan coba lagi.'], 500);
        }
    }

}
