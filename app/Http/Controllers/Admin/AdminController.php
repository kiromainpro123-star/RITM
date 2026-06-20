<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\News;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $newsCount = News::count();
        $enrollmentsCount = Enrollment::count();
        return view('admin.index', compact('newsCount', 'enrollmentsCount'));
    }

    public function database()
    {
        $users       = DB::table('users')->get();
        $news        = DB::table('news')->get();
        $news_media  = DB::table('news_media')->get();
        $enrollments = DB::table('enrollments')->get();
        $migrations  = DB::table('migrations')->get();
        return view('admin.database', compact('users', 'news', 'news_media', 'enrollments', 'migrations'));
    }
}
