<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Http\HttpClientOptions;

class FetchFirebaseData extends Command
{
    protected $signature = 'firebase:fetch-data';
    protected $description = 'Fetch data from Firebase Realtime Database for management users and sensor data';    public function handle()
    {
        $factory = (new Factory)
            ->withServiceAccount(config_path('firebase_credentials.json'))
            ->withHttpClientOptions(
                HttpClientOptions::default()->withGuzzleConfigOption('verify', false)
            );
        $database = $factory->createDatabase();

        $nfcCards = $database->getReference('nfc_cards')->getValue();
        $sensorData = $database->getReference('sensor_data')->getValue();

        $this->info("Management User Data (nfc_cards):");
        $this->line(print_r($nfcCards, true));
        $this->info("Sensor Data:");
        $this->line(print_r($sensorData, true));

        return 0;
    }
}
