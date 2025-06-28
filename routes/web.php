<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ManagementUserController;
use App\Http\Controllers\SensorDataController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'showLogIn'])->name('login');
Route::get('/signup', [AuthController::class, 'showSignUp'])->name('register'); 
Route::post('/signup', [AuthController::class, 'register'])->name('register.submit');
Route::get('/about', [AboutController::class, 'showAbout'])->name('about');
Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/management-user', [ManagementUserController::class, 'index'])->name('management.user');
Route::get('/management-user/{uid}/edit', [ManagementUserController::class, 'edit'])->name('management.user.edit');
Route::put('/management-user/{uid}', [ManagementUserController::class, 'update'])->name('management.user.update');
Route::delete('/management-user/{uid}', [ManagementUserController::class, 'destroy'])->name('management.user.destroy');

Route::get('/sensor-data', [SensorDataController::class, 'index'])->name('sensor.data');

// Test Firebase connection
Route::get('/test-firebase', function() {
    try {
        $serviceAccountPath = config_path('io-lock-firebase-adminsdk-fbsvc-a545335fa2.json');
        
        if (!file_exists($serviceAccountPath)) {
            return response()->json(['error' => 'File not found: ' . $serviceAccountPath], 500);
        }
        
        $credentials = json_decode(file_get_contents($serviceAccountPath), true);
        
        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json(['error' => 'Invalid JSON: ' . json_last_error_msg()], 500);
        }
        
        $factory = (new \Kreait\Firebase\Factory)
            ->withServiceAccount($credentials)
            ->withDatabaseUri('https://io-lock-default-rtdb.asia-southeast1.firebasedatabase.app/')
            ->withHttpClientOptions(
                \Kreait\Firebase\Http\HttpClientOptions::default()
                    ->withGuzzleConfigOption('verify', false)
                    ->withGuzzleConfigOption('timeout', 60)
                    ->withGuzzleConfigOption('connect_timeout', 30)
                    ->withGuzzleConfigOption('curl', [
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_SSL_VERIFYHOST => false,
                        CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2
                    ])
            );
        
        $database = $factory->createDatabase();
        $ref = $database->getReference('/');
        $snapshot = $ref->getSnapshot();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Firebase connection successful',
            'data' => $snapshot->getValue()
        ]);
        
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error', 
            'message' => $e->getMessage(),
            'type' => get_class($e)
        ], 500);
    }
});
