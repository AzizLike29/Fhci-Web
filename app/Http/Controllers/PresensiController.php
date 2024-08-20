<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PresensiController extends Controller
{
    public function index()
    {
        $user = !Auth::check() ? null : Auth::user();
        $attendances = Attendance::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->take(30)
            ->get();

        return view('components/pages/time/index', compact('user', 'attendances'));
    }

    public function checkIn(Request $request)
    {
        $user = Auth::check() ? Auth::user() : null;
        $now = Carbon::now();

        $attendance = Attendance::firstOrCreate(
            ['user_id' => $user->id, 'date' => $now->toDateString()],
            ['check_in' => $now->toTimeString(), 'status' => 'Hadir', 'alasan' => '-']
        );

        // Redirect ke halaman presensi setelah check-in berhasil
        return redirect()->route('presensi.index')->with('message', 'Check-in berhasil');
    }

    public function checkOut(Request $request)
    {
        $user = Auth::check() ? Auth::user() : null;
        $now = Carbon::now();

        $attendance = Attendance::where('user_id', $user->id)
            ->where('date', $now->toDateString())
            ->first();

        if ($attendance) {
            $attendance->update(['check_out' => $now->toTimeString()]);
            // Redirect ke halaman presensi setelah check-out berhasil
            return redirect()->route('presensi.index')->with('message', 'Check-out berhasil');
        } else {
            Attendance::create([
                'user_id' => $user->id,
                'date' => $now->toDateString(),
                'check_out' => $now->toTimeString(),
                'status' => 'Tidak Hadir'
            ]);
            return redirect()->route('presensi.index')->with('error', 'Tidak ada check-in hari ini, status diatur ke Tidak Hadir.');
        }
    }
}
