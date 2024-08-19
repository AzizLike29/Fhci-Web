<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AbsenceController extends Controller
{

    public function index()
    {
        return view('components.pages.time.absence_form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|in:izin,sakit',
            'notes' => 'required|string|max:255',
        ]);

        $user = !Auth::check() ? null : Auth::user();
        $now = Carbon::now();

        Attendance::create([
            'user_id' => $user->id,
            'date' => $now->toDateString(),
            'status' => $request->reason,
            'notes' => $request->notes,
        ]);

        return redirect()->route('presensi.index')->with('success', 'Ketidakhadiran berhasil dilaporkan');
    }
}
