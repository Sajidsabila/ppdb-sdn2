<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth-admin');
    }

    public function auth(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email Tidak Boleh Kosong',
            'password.required' => 'Password Tidak Boleh Kosong',
            'email.email' => 'Tipe Data Harus Email'
        ]);
        try {
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user = Auth::user();

                if ($user->role === 'admin' || $user->role === 'operator') {
                    return redirect()->route('admin.home');
                }
                Auth::logout();
                return back()->with('error', "Username dan Password Salah");

            } else {
                return back()->with('error', "Email atau Password Salah");
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi Kesalahan: ' . $th->getMessage());
        }

    }
}
