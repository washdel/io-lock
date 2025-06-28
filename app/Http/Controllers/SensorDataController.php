<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory; // Ensure package is installed with "composer require kreait/firebase-php"
use Kreait\Firebase\Http\HttpClientOptions;

class SensorDataController extends Controller
{
    public function index()
    {
        $serviceAccountPath = config_path('firebase_credentials.json');
        logger('Service account path: ' . $serviceAccountPath);        $factory = (new Factory)
            ->withServiceAccount($serviceAccountPath)
            ->withDatabaseUri('https://io-lock-default-rtdb.asia-southeast1.firebasedatabase.app/')
            ->withHttpClientOptions(HttpClientOptions::default()->withGuzzleConfigOption('verify', false)); // Disable SSL verification for development
        $database = $factory->createDatabase();
        // Retrieves sensor data from "sensor_data"
        $sensorData = $database->getReference('sensor_data')->getValue();

        return view('sensor_data', ['sensorData' => $sensorData]);
    }
}
