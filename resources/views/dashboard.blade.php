@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="pagehead">
    <div><div class="eyebrow">Overview</div><h1>Welcome to your school dashboard</h1><div class="muted">A quick view of student records, courses, and learning activity.</div></div>
    <a class="btn" href="{{ route('students.create') }}">＋ Register student</a>
</div>
<div class="stats">
    <div class="stat"><small>Total students</small><strong>{{ number_format($stats['students']) }}</strong><span class="muted">Registered learners</span></div>
    <div class="stat"><small>Courses</small><strong>{{ number_format($stats['courses']) }}</strong><span class="muted">Available courses</span></div>
    <div class="stat"><small>Activities</small><strong>{{ number_format($stats['activities']) }}</strong><span class="muted">Learning tasks</span></div>
    <div class="stat"><small>Submissions</small><strong>{{ number_format($stats['submissions']) }}</strong><span class="muted">Work submitted</span></div>
</div>
<div class="detailgrid">
    <section class="card">
        <div class="pagehead"><div><div class="eyebrow">Directory</div><h2 style="margin:4px 0">Recently added students</h2></div><a href="{{ route('students.index') }}">View all →</a></div>
        @forelse($recentStudents as $student)
            <div class="item"><strong>{{ $student->full_name }}</strong><div class="muted">{{ $student->student_number }} · {{ $student->email }}</div><div style="margin-top:8px"><a class="btn secondary small" href="{{ route('students.show', $student) }}">View profile</a></div></div>
        @empty
            <div class="empty"><strong>No students yet</strong>Register a student to start building your directory.</div>
        @endforelse
    </section>
    <section class="card">
        <div class="eyebrow">Coming up</div><h2 style="margin:4px 0 12px">Upcoming activities</h2>
        @forelse($upcomingActivities as $activity)
            <div class="item"><strong>{{ $activity->title }}</strong><div class="muted">{{ $activity->course->code }} · Due {{ $activity->due_date->format('M d, Y g:i A') }}</div><div style="margin-top:8px"><a class="btn secondary small" href="{{ route('activities.show', $activity) }}">View activity</a></div></div>
        @empty
            <div class="empty"><strong>No upcoming activities</strong>New activities will appear here when you create them.</div>
        @endforelse
        <a class="btn secondary" href="{{ route('activities.index') }}">Manage activities</a>
    </section>
</div>
@endsection
