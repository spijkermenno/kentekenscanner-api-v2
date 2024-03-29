<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\GekentekendeVoertuigen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

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
        $unvalidatedImages = Image::with("gekentekendeVoertuigen")->where('validated', false)->get();
        return response()->json(['images' => $unvalidatedImages]);
    }

    public function getValidatedImages()
    {
        $validatedImages = Image::with("gekentekendeVoertuigen")->where('validated', true)->get();
        return response()->json(['images' => $validatedImages]);
    }

    public function showUnvalidatedImages()
    {
        $unvalidatedImages = Image::where('validated', false)->get();

        return View::make('unvalidated-images', ['unvalidatedImages' => $unvalidatedImages]);
    }

    public function getAllImages() {
        $unvalidatedImagesCount = Image::with("gekentekendeVoertuigen")->get();
        return response()->json(['images' => $unvalidatedImagesCount]);
    }

    public function validateImage($imageId)
    {
        $image = Image::find($imageId);

        if (!$image) {
            return response()->json(['error' => 'Image not found'], 404);
        }

        // Perform validation logic (update the 'validated' field, etc.)
        $image->validated = true;
        $image->save();

        return response()->json(['message' => 'Image approved successfully', 'image' => $image]);
    }

    public function deleteImage($imageId)
    {
        $image = Image::find($imageId);

        if (!$image) {
            return response()->json(['error' => 'Image not found'], 404);
        }

        // Perform deletion logic (delete the image record, remove associated file, etc.)
        $image->delete();

        return response()->json(['message' => 'Image deleted successfully']);
    }

    public function getUnvalidatedImagesCount()
    {
        $unvalidatedImagesCount = Image::where('validated', false)->count();
        return response()->json(['count' => $unvalidatedImagesCount]);
    }

    public function getValidatedImagesCount()
    {
        $validatedImagesCount = Image::where('validated', true)->count();
        return response()->json(['count' => $validatedImagesCount]);
    }

    public function getImagesCount()
    {
        $imageCount = Image::all()->count();
        return response()->json(['count' => $imageCount]);
    }

}