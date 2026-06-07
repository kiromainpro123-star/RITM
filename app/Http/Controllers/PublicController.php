<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\News;

class PublicController extends Controller
{
    public function index()
    {
        $news = News::where('published', true)->with('media')->latest()->take(3)->get();
        return view('public.index', compact('news'));
    }

    public function news()
    {
        $news = News::where('published', true)->with('media')->latest()->paginate(9);
        return view('public.news', compact('news'));
    }

    public function newsShow($id)
    {
        $item = News::where('published', true)->with('media')->findOrFail($id);
        return view('public.news_show', compact('item'));
    }

    public function gallery()
    {
        $photos = Gallery::latest()->paginate(12);
        return view('public.gallery', compact('photos'));
    }
}
