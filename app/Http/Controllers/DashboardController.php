<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Kreait\Firebase\Factory; // Ensure package is installed with "composer require kreait/firebase-php"
use Kreait\Firebase\Http\HttpClientOptions;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        try {
            Log::info('Starting Firebase connection...');
            
            $serviceAccountPath = config_path('io-lock-firebase-adminsdk-fbsvc-a545335fa2.json');
            
            if (!file_exists($serviceAccountPath)) {
                Log::error('Firebase credentials file not found at: ' . $serviceAccountPath);
                return response()->json(['error' => 'Firebase credentials file not found'], 500);
            }

            $credentialsContent = file_get_contents($serviceAccountPath);
            $credentials = json_decode($credentialsContent, true);
            
            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('Invalid JSON in Firebase credentials: ' . json_last_error_msg());
                return response()->json(['error' => 'Invalid Firebase credentials format'], 500);
            }

            Log::info('Credentials loaded successfully');

            $factory = (new Factory)
                ->withServiceAccount($credentials)
                ->withDatabaseUri('https://io-lock-default-rtdb.asia-southeast1.firebasedatabase.app/')
                ->withHttpClientOptions(
                    HttpClientOptions::default()
                        ->withGuzzleConfigOption('verify', false)
                        ->withGuzzleConfigOption('timeout', 60)
                        ->withGuzzleConfigOption('connect_timeout', 30)
                        ->withGuzzleConfigOption('curl', [
                            CURLOPT_SSL_VERIFYPEER => false,
                            CURLOPT_SSL_VERIFYHOST => false,
                            CURLOPT_SSLVERSION => CURL_SSLVERSION_TLSv1_2
                        ])
                );

            Log::info('Factory created, connecting to database...');
            $database = $factory->createDatabase();
            
            Log::info('Database connected, retrieving data...');
            $users = $database->getReference('nfc_cards')->getValue();
            $sensorData = $database->getReference('sensor_data')->getValue();
            
            Log::info('Data retrieved successfully');
            
            return view('dashboard', [
                'users' => $users ?? [],
                'sensorData' => $sensorData ?? []
            ]);
            
        } catch (\Exception $e) {
            Log::error('Firebase connection error: ' . $e->getMessage());
            Log::error('Error type: ' . get_class($e));
            
            return response()->json([
                'error' => 'Firebase connection failed: ' . $e->getMessage(),
                'type' => get_class($e)
            ], 500);
        }
    }
}
