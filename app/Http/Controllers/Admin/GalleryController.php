<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $photos = Gallery::latest()->paginate(12);
        return view('admin.gallery.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.gallery.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'nullable|string|max:255',
            'images' => 'required|array',
            'images.*' => 'image|max:4096',
        ]);

        foreach ($request->file('images') as $file) {
            Gallery::create([
                'title' => $request->title,
                'image' => $file->store('gallery', 'public'),
            ]);
        }

        return redirect()->route('admin.gallery.index')->with('success', 'Фото добавлены');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Фото удалено');
    }
}
