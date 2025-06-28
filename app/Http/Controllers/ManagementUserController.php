<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory; // Ensure package is installed with "composer require kreait/firebase-php"
use Kreait\Firebase\Http\HttpClientOptions;

class ManagementUserController extends Controller
{    public function index()
    {        $serviceAccountPath = config_path('firebase_credentials.json');
        logger('Service account path: ' . $serviceAccountPath);        $factory = (new Factory)
            ->withServiceAccount($serviceAccountPath)
            ->withDatabaseUri('https://io-lock-default-rtdb.asia-southeast1.firebasedatabase.app/')
            ->withHttpClientOptions(
                HttpClientOptions::default()->withGuzzleConfigOption('verify', false)
            );
        $database = $factory->createDatabase();
        $users = $database->getReference('nfc_cards')->getValue();

        return view('management_user', ['users' => $users]);
    }    public function edit($uid)
    {        $serviceAccountPath = config_path('firebase_credentials.json');        $factory = (new Factory)
            ->withServiceAccount($serviceAccountPath)
            ->withDatabaseUri('https://io-lock-default-rtdb.asia-southeast1.firebasedatabase.app/')
            ->withHttpClientOptions(
                HttpClientOptions::default()->withGuzzleConfigOption('verify', false)
            );
        $database = $factory->createDatabase();
        $user = $database->getReference("nfc_cards/{$uid}")->getValue();

        return view('edit_user', ['uid' => $uid, 'user' => $user]);
    }

    public function update(Request $request, $uid)
    {        $data = $request->only(['uid', 'username', 'nama', 'akses_level', 'password']);
        $newUid = $data['uid'];        $serviceAccountPath = config_path('firebase_credentials.json');        $factory = (new \Kreait\Firebase\Factory)
            ->withServiceAccount($serviceAccountPath)
            ->withDatabaseUri('https://io-lock-default-rtdb.asia-southeast1.firebasedatabase.app/')
            ->withHttpClientOptions(
                HttpClientOptions::default()->withGuzzleConfigOption('verify', false)
            );
        $database = $factory->createDatabase();

        if ($newUid !== $uid) {
             // Create new record under new UID
             $database->getReference("nfc_cards/{$newUid}")->set([
                 'username' => $data['username'],
                 'nama' => $data['nama'],
                 'akses_level' => $data['akses_level'],
                 'password' => $data['password']
             ]);
             // Remove the old record
             $database->getReference("nfc_cards/{$uid}")->remove();
        } else {
             // Just update the existing record
             $database->getReference("nfc_cards/{$uid}")->update([
                 'username' => $data['username'],
                 'nama' => $data['nama'],
                 'akses_level' => $data['akses_level'],
                 'password' => $data['password']
             ]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy($uid)
    {        logger("Deleting user with UID: " . $uid);
        $serviceAccountPath = config_path('firebase_credentials.json');
        $factory = (new \Kreait\Firebase\Factory)
            ->withServiceAccount($serviceAccountPath)
            ->withDatabaseUri('https://io-lock-default-rtdb.asia-southeast1.firebasedatabase.app/')
            ->withHttpClientOptions(
                HttpClientOptions::default()->withGuzzleConfigOption('verify', false)
            );
        $database = $factory->createDatabase();
        $database->getReference("nfc_cards/{$uid}")->remove();

        return redirect()->route('management.user')->with('success', 'User deleted successfully.');
    }
}
