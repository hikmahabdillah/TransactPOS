<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (Auth::check()) { // jika sudah login, maka redirect ke halaman home
            return redirect('/');
        }
        return view('auth.login');
    }

    public function postlogin(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $credentials = $request->only('username', 'password');

            if (Auth::attempt($credentials)) {
                return response()->json([
                    'status' => true,
                    'message' => 'Login Berhasil',
                    'redirect' => url('/')
                ]);
            }

            return response()->json([
                'status' => false,
                'message' => 'Login Gagal'
            ]);
        }

        return redirect('login');
    }

    public function register()
    {
        if (Auth::check()) { // jika sudah login, maka redirect ke halaman home
            return redirect('/');
        }
        return view('auth.register');
    }


    public function postregister(Request $request)
    {
        if ($request->ajax() || $request->wantsJson()) {
            $request->validate([
                'username' => 'required|unique:m_user,username',
                'nama' => 'required',
                'password' => 'required|min:6',
                'level_id' => 'required|integer'
            ]);

            // Simpan user baru ke database
            $user = new UserModel([
                'username' => $request->username,
                'nama' => $request->nama,
                'password' => $request->password, // otomatis di-hash jika pakai casts
                'level_id' => $request->level_id,
            ]);

            $user->save();

            // Login otomatis setelah register
            Auth::login($user);

            return response()->json([
                'status' => true,
                'message' => 'Register Berhasil',
                'redirect' => url('/')
            ]);
        }

        return redirect('auth.register');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
