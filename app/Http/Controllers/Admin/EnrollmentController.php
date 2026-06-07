<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;

class EnrollmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        $enrollments = Enrollment::with('user')->latest()->paginate(20);
        return view('admin.enrollments.index', compact('enrollments'));
    }

    public function toggle(Enrollment $enrollment)
    {
        $enrollment->processed = ! $enrollment->processed;
        $enrollment->save();

        return back()->with('success', $enrollment->processed
            ? 'Статус заявки изменён на «Обработано».'
            : 'Статус заявки изменён на «На рассмотрении».'
        );
    }
}
