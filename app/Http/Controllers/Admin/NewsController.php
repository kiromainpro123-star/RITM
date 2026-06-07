<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsMedia;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $news = News::latest()->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.form', ['item' => null]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required|string',
            'image'     => 'nullable|image|max:4096',
            'published' => 'nullable|boolean',
            'media.*'   => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,mp4,mov,avi|max:51200',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }
        $data['published'] = $request->has('published');

        $news = News::create($data);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $mime = $file->getMimeType();
                $type = str_starts_with($mime, 'video') ? 'video' : 'image';
                NewsMedia::create([
                    'news_id' => $news->id,
                    'file'    => $file->store('news_media', 'public'),
                    'type'    => $type,
                ]);
            }
        }

        return redirect()->route('admin.news.index')->with('success', 'Новость добавлена');
    }

    public function edit(News $news)
    {
        return view('admin.news.form', ['item' => $news->load('media')]);
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title'     => 'required|string|max:255',
            'content'   => 'required|string',
            'image'     => 'nullable|image|max:4096',
            'published' => 'nullable|boolean',
            'media.*'   => 'nullable|file|mimes:jpg,jpeg,png,gif,webp,mp4,mov,avi|max:51200',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }
        $data['published'] = $request->has('published');

        $news->update($data);

        if ($request->hasFile('media')) {
            foreach ($request->file('media') as $file) {
                $mime = $file->getMimeType();
                $type = str_starts_with($mime, 'video') ? 'video' : 'image';
                NewsMedia::create([
                    'news_id' => $news->id,
                    'file'    => $file->store('news_media', 'public'),
                    'type'    => $type,
                ]);
            }
        }

        return redirect()->route('admin.news.index')->with('success', 'Новость обновлена');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Новость удалена');
    }

    public function destroyMedia(NewsMedia $media)
    {
        $media->delete();
        return back()->with('success', 'Файл удалён');
    }
}
