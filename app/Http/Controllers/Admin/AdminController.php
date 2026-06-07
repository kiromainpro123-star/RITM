<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\News;

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
}
