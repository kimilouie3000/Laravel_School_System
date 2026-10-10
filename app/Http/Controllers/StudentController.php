<?php
namespace App\Http\Controllers;
use App\Models\Course; use App\Models\Student; use Illuminate\Http\Request; use Illuminate\Validation\Rule;
class StudentController extends Controller {
 public function index(){ $students=Student::withCount('courses')->orderBy('last_name')->paginate(10); return view('students.index',compact('students')); }
 public function create(){ return view('students.create'); }
 public function store(Request $request){ $data=$request->validate(['student_number'=>'required|string|max:50|unique:students,student_number','first_name'=>'required|string|max:100','last_name'=>'required|string|max:100','email'=>'required|email|max:255|unique:students,email','date_of_birth'=>'required|date|before:today']); Student::create($data); return redirect()->route('students.index')->with('success','Student registered successfully.'); }
 public function show(Student $student){ $student->load('courses'); $availableCourses=Course::whereNotIn('id',$student->courses->pluck('id'))->orderBy('code')->get(); return view('students.show',compact('student','availableCourses')); }
 public function edit(Student $student){ return view('students.edit',compact('student')); }
 public function update(Request $request, Student $student){ $data=$request->validate(['student_number'=>['required','string','max:50',Rule::unique('students')->ignore($student->id)],'first_name'=>'required|string|max:100','last_name'=>'required|string|max:100','email'=>['required','email','max:255',Rule::unique('students')->ignore($student->id)],'date_of_birth'=>'required|date|before:today']); $student->update($data); return redirect()->route('students.show',$student)->with('success','Student details updated.'); }
 public function enroll(Request $request, Student $student){ $data=$request->validate(['course_id'=>'required|exists:courses,id']); if($student->courses()->where('courses.id',$data['course_id'])->exists()) return back()->withErrors(['course_id'=>'This student is already enrolled in that course.']); $student->courses()->attach($data['course_id'],['enrolled_at'=>now()->toDateString()]); return redirect()->route('students.show',$student)->with('success','Course enrollment saved.'); }
 public function unenroll(Student $student, Course $course){ $student->courses()->detach($course->id); return redirect()->route('students.show',$student)->with('success','Student unenrolled from the course.'); }
 public function destroy(Student $student){ $student->delete(); return redirect()->route('students.index')->with('success','Student record deleted.'); }
}
