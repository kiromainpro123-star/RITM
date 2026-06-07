<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $enrollments = auth()->user()->enrollments()->latest()->get();
        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        return view('enrollments.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'child_name' => 'required|string|max:255',
            'child_age' => 'required|integer|min:3|max:25',
            'club' => 'required|string|max:255',
            'parent_phone' => 'required|string|max:30',
            'notes' => 'nullable|string|max:1000',
        ]);

        auth()->user()->enrollments()->create($data);

        return redirect()->route('enroll.index')->with('success', 'Запись на кружок успешно отправлена. Наш администратор свяжется с вами.');
    }
}
