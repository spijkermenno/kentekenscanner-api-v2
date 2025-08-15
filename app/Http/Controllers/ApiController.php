<?php

namespace App\Http\Controllers;

use App\Models\Carrosseriegegevens;
use App\Models\Emissiegegevens;
use App\Models\GekentekendeVoertuigen;
use Http;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index()
    {
        $data = GekentekendeVoertuigen::with('carrosserieGegevens', 'emissieGegevens')->get();
        return response()->json($data);
    }


    // public function getByKenteken(Request $request, $kenteken)
    // {
    //     $kenteken = strtoupper($kenteken);
        
    //     $item = GekentekendeVoertuigen::with('carrosserieGegevens', 'emissieGegevens', 'images')
    //         ->where('kenteken', $kenteken)
    //         ->first();

    //     if (!$item) {
    //         $newItem = $this->getGekentekendeVoertuigenFromAPI($kenteken);

    //         if ($newItem instanceof GekentekendeVoertuigen) {
    //            return $this->getByKenteken($request, $kenteken);
    //         } else {
    //             return response()->json(['message' => 'Item not found'], 404);
    //         }
    //     }

    //     return response()->json($item);
    // }

    public function getByKenteken(Request $request, $kenteken)
{
    $kenteken = strtoupper($kenteken);
    
    $item = GekentekendeVoertuigen::with('carrosserieGegevens', 'emissieGegevens', 'images')
        ->where('kenteken', $kenteken)
        ->first();

    // Check if item doesn't exist OR if it's older than today
    if (!$item || $this->isItemOutdated($item)) {
        $newItem = $this->getGekentekendeVoertuigenFromAPI($kenteken);

        if ($newItem instanceof GekentekendeVoertuigen) {
            // Reload the item with relationships instead of recursive call
            $item = GekentekendeVoertuigen::with('carrosserieGegevens', 'emissieGegevens', 'images')
                ->where('kenteken', $kenteken)
                ->first();
                
            return response()->json($item);
        } else {
            return response()->json(['message' => 'Item not found'], 404);
        }
    }

    return response()->json($item);
}

/**
 * Check if the item is older than today
 */
private function isItemOutdated($item)
{
    // Check if updated_at is older than today (start of today)
    return $item->updated_at->startOfDay()->lt(now()->startOfDay());
}

    public function getAllCarrosserieGegevens()
    {
        $carrosserieGegevens = CarrosserieGegevens::all();

        return response()->json($carrosserieGegevens);
    }

    public function getAllEmissieGegevens()
    {
        $emissieGegevens = EmissieGegevens::all();

        return response()->json($emissieGegevens);
    }


    private function getGekentekendeVoertuigenFromAPI($kenteken) {
        $response = Http::get("https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken={$kenteken}");

        if ($response->successful()) {
            return $this->createGekentekendeVoertuigenItem($response->json());
        }

        return null;
    }

    private function getCarrosserieGegevensFromAPI($kenteken) {
        $response = Http::get("https://opendata.rdw.nl/resource/vezc-m2t6.json?kenteken={$kenteken}");

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    private function getEmissieGegevensFromAPI($kenteken) {
        $response = Http::get("https://opendata.rdw.nl/resource/8ys7-d773.json?kenteken={$kenteken}");

        if ($response->successful()) {
            return $response->json();
        }


        return null;
    }

    private function createGekentekendeVoertuigenItem($json) {
        if ($json) {
            $fillableColumns = (new GekentekendeVoertuigen())->getFillable();

            $filteredData = array_intersect_key($json[0], array_flip($fillableColumns));

            $gekentekendVoertuig = GekentekendeVoertuigen::create($filteredData);
            
            $carrosserieArray = $this->createCarrosserieGegevensItem($this->getCarrosserieGegevensFromAPI($gekentekendVoertuig->kenteken), $gekentekendVoertuig->id);
            $emissieArray = $this->createEmissieGegevensItem($this->getEmissieGegevensFromAPI($gekentekendVoertuig->kenteken), $gekentekendVoertuig->id);

            foreach ($carrosserieArray as $carrosserie) {
                $carrosserie->gekentekendeVoertuig()->associate($gekentekendVoertuig);
            }
            
            foreach ($emissieArray as $emissie) {
                $emissie->gekentekendeVoertuig()->associate($gekentekendVoertuig);
            }

            $gekentekendVoertuig->save();
    
            return $gekentekendVoertuig;
        }
    }
    
    private function createCarrosserieGegevensItem($json, $gekentekendVoertuigId) {
        if ($json) {
            $fillableColumns = (new Carrosseriegegevens())->getFillable();
            $filteredData = [];
            $createdItems = [];

            foreach($json as $item) {
                $filteredData[] = array_intersect_key($item, array_flip($fillableColumns));
            }
    

            foreach($filteredData as $item) {
                $item["gekentekende_voertuig_id"] = $gekentekendVoertuigId;
                $createdItems[] = CarrosserieGegevens::create($item);
            }

            return $createdItems;
        }
    }
    
    private function createEmissieGegevensItem($json, $gekentekendVoertuigId) {
        if ($json) {
            $fillableColumns = (new Emissiegegevens())->getFillable();

            $filteredData = [];
            $createdItems = [];

            foreach($json as $item) {
                $filteredData[] = array_intersect_key($item, array_flip($fillableColumns));
            }
    
            foreach($filteredData as $item) {
                $item["gekentekende_voertuig_id"] = $gekentekendVoertuigId;
                $createdItems[] = Emissiegegevens::create($item);
            }
    
            return $createdItems;
        }
    }
}
