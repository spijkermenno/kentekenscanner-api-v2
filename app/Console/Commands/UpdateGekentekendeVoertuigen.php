<?php

namespace App\Console\Commands;

use App\Models\GekentekendeVoertuigen;
use Http;
use Illuminate\Console\Command;

class UpdateGekentekendeVoertuigen extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-gekentekende-voertuigen';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->updateGekentekendeVoertuigen();    
    }

    private function updateGekentekendeVoertuigen()
    {
        // Retrieve all gekentekendeVoertuigen
        $vehicles = GekentekendeVoertuigen::all();

        foreach ($vehicles as $vehicle) {
            // Build the URL for each vehicle
            $url = "https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken={$vehicle->kenteken}&\$select=kenteken,vervaldatum_apk,datum_tenaamstelling,vervaldatum_tachograaf,registratie_datum_goedkeuring_afschrijvingsmoment_bpm,tellerstandoordeel";

            $this->info('Start processing... ' . $vehicle->kenteken);

            // Fetch data from the URL
            $response = Http::get($url);

            if ($response->successful()) {
                $this->info('Date fetched...');
                $data = $response->json()[0];

                // Update the gekentekendeVoertuigen record with new data
                $result = $vehicle->update([
                    'vervaldatum_apk' => $data['vervaldatum_apk'] ?? null,
                    'datum_tenaamstelling' => $data['datum_tenaamstelling'] ?? null,
                    'vervaldatum_tachograaf' => $data['vervaldatum_tachograaf'] ?? null,
                    'registratie_datum_goedkeuring_afschrijvingsmoment_bpm' => $data['registratie_datum_goedkeuring_afschrijvingsmoment_bpm'] ?? null,
                    'tellerstandoordeel' => $data['tellerstandoordeel'] ?? null,
                    'updated_at' => now()
                ]);
            } else {
                $this->error('Error message');
            }
        }
    }
}
