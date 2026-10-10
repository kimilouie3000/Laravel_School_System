<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Course;
use App\Models\Student;
use App\Models\Submission;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'students' => Student::count(),
            'courses' => Course::count(),
            'activities' => Activity::count(),
            'submissions' => Submission::count(),
        ];

        $recentStudents = Student::latest()->take(5)->get();
        $upcomingActivities = Activity::with('course')
            ->whereDate('due_date', '>=', today())
            ->orderBy('due_date')
            ->take(5)
            ->get();

        return view('dashboard', compact('stats', 'recentStudents', 'upcomingActivities'));
    }
}
