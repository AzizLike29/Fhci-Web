<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('components.pages.login');
    }

    public function prosLogin(Request $request)
    {
        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->back();
        }
        return redirect()->route('presensi.index');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
