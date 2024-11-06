<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class ImageController extends Controller
{
    /**
     * Display a listing of the images.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $images = Image::all();  // Retrieve all images from the database
        return view('upload', compact('images'));  // Pass the images to the view
    }

    /**
     * Store a newly uploaded image in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request to ensure the image is of correct type and size
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Check if the image file is present in the request
        if ($request->hasFile('image')) {
            // Store the image in the 'public/images' directory
            $path = $request->file('image')->store('images', 'public');

            // Create a new Image record in the database
            Image::create(['filepath' => $path]);

            // Return a success message and redirect back to the form
            return redirect()->back()->with('success', 'Image uploaded successfully.');
        }

        // If the image is not uploaded, return an error message
        return redirect()->back()->with('error', 'Image upload failed.');
    }
}