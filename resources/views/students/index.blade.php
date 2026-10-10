@extends('layouts.app')
@section('title','Students')
@section('content')
<div class="pagehead"><div><div class="eyebrow">Directory</div><h1>Student records</h1><div class="muted">Manage student details and course enrollment.</div></div><a class="btn" href="{{ route('students.create') }}">＋ Register student</a></div>
<div class="stats"><div class="stat"><small>Total students on this page</small><strong>{{ $students->count() }}</strong></div><div class="stat"><small>Current page</small><strong>{{ $students->currentPage() }} <span class="muted" style="font-size:14px">/ {{ $students->lastPage() }}</span></strong></div></div>
<div class="card"><div class="tablewrap"><table><thead><tr><th>Student</th><th>Student number</th><th>Email</th><th>Courses</th><th>Actions</th></tr></thead><tbody>
@forelse($students as $student)<tr><td><strong>{{ $student->full_name }}</strong><div class="muted" style="font-size:12px">Born {{ $student->date_of_birth->format('M d, Y') }}</div></td><td><span class="pill gray">{{ $student->student_number }}</span></td><td>{{ $student->email }}</td><td><span class="pill">{{ $student->courses_count }} courses</span></td><td><div class="actions"><a class="btn small" href="{{ route('students.show',$student) }}">View</a><a class="btn secondary small" href="{{ route('students.edit',$student) }}">Edit</a><form action="{{ route('students.destroy',$student) }}" method="POST" onsubmit="return confirm('Delete this student and their related submissions?')">@csrf @method('DELETE')<button class="btn danger small">Delete</button></form></div></td></tr>
@empty<tr><td colspan="5"><div class="empty"><strong>No student records yet</strong>Register the first student to get started.</div></td></tr>@endforelse
</tbody></table></div><div class="pagination">{{ $students->links() }}</div></div>
@endsection
