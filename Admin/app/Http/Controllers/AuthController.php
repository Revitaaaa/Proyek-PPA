<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Fungsi Register (Daftar Akun)
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|size:16',      // Wajib persis 16 karakter
            'no_hp' => 'required|string|size:12',    // Wajib persis 12 karakter
            'email' => 'required|string|email|max:255|unique:user', // Wajib unik/tidak boleh duplikat di tabel user
            'password' => 'required|string|min:3|max:7', // 3 - 7 karakter
        ]);

        $user = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'tanggal_lahir' => $request->tanggal_lahir,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Registrasi berhasil',
            'data' => $user
        ], 201);
    }

    // Fungsi Login (Masuk Akun)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email atau password salah!'
            ], 401);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Login berhasil',
            'data' => $user
        ], 200);
    }
}