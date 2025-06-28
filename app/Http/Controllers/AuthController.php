<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Http\HttpClientOptions;

class AuthController extends Controller
{
    public function showLogIn()
    {
        return view('login');
    }

    public function showSignUp()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:4|confirmed',
        ]);

        $nama = $request->first_name . ' ' . $request->last_name;
        $data = [
            'unassign' => true,
            'akses_level' => 'user',
            'nama' => $nama,
            'password' => $request->password,
            'username' => $request->username,
        ];

        $uid = 'unassign_' . uniqid('', true);

        try {
            $serviceAccountPath = config_path('firebase_credentials.json');
            $factory = (new Factory)->withServiceAccount($serviceAccountPath)
                ->withDatabaseUri('https://io-lock-default-rtdb.asia-southeast1.firebasedatabase.app/')
                ->withHttpClientOptions(
                    HttpClientOptions::default()->withGuzzleConfigOption('verify', false)
                );
            $database = $factory->createDatabase();
            $database->getReference('nfc_cards/' . $uid)->set($data);
        } catch (\Throwable $e) {
            return back()->withErrors(['firebase' => 'Gagal menyimpan ke Firebase: ' . $e->getMessage()]);
        }

        return redirect()->route('login')->with('success', 'Registration successful! Data sent to admin.');
    }
}
