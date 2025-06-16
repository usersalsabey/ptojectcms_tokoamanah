<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function create()
    {
        $images = Image::latest()->get();
        return view('upload', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('image')->store('uploads', 'public');

        $image = Image::create([
            'title' => $request->title,
            'image_path' => $path
        ]);

        return redirect('/upload')->with('success', 'Gambar berhasil diupload!')->with('image', $image);
    }

    public function gallery()
{
    $images = Image::latest()->get();
    return view('image.gallery', compact('images'));
}


    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        
        Storage::disk('public')->delete($image->image_path);

        $image->delete();

        return redirect('/upload')->with('success', 'Gambar berhasil dihapus!');
    }
}
