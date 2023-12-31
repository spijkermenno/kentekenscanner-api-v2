<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\GekentekendeVoertuigen;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index($gekentekendeVoertuigenId)
    {
        $vehicle = GekentekendeVoertuigen::find($gekentekendeVoertuigenId);

        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }

        $images = $vehicle->images;

        // Transform the file_path to a full URL
       

        return response()->json(['images' => $images]);
    }

    public function store(Request $request, $gekentekendeVoertuigenId)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if the gekentekende_voertuigen_id exists
        $vehicle = GekentekendeVoertuigen::find($gekentekendeVoertuigenId);

        if (!$vehicle) {
            return response()->json(['error' => 'Vehicle not found'], 404);
        }

        $imagePath = $request->file('image')->store('images', 'public');

        $image = new Image([
            'gekentekende_voertuigen_id' => $gekentekendeVoertuigenId,
            'file_path' => asset("storage/{$imagePath}")
        ]);

        $image->save();

        return response()->json(['message' => 'Image uploaded successfully']);
    }

    public function getUnvalidatedImages()
    {
        $unvalidatedImages = Image::where('validated', false)->get();
        return response()->json(['images' => $unvalidatedImages]);
    }

    public function getUnvalidatedImagesCount()
    {
        $unvalidatedImagesCount = Image::where('validated', false)->count();
        return response()->json(['count' => $unvalidatedImagesCount]);
    }

    public function DeleteImage($imageId)
    {
        $image = Image::find($imageId);

        if (!$image) {
            return response()->json(['error' => 'Image not found'], 404);
        }

        $image->delete();

        $image->save();

        return response()->json(['message' => 'Image validated successfully']);
    }

    public function validateImage($imageId)
    {
        $image = Image::find($imageId);

        if (!$image) {
            return response()->json(['error' => 'Image not found'], 404);
        }

        $image->validated = true; 

        $image->save();

        return response()->json(['message' => 'Image validated successfully']);

    }

}