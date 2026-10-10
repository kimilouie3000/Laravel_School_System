<?php
namespace App\Http\Controllers;
use App\Models\Course; use Illuminate\Http\Request; use Illuminate\Validation\Rule;
class CourseController extends Controller {
 public function index(){ $courses=Course::withCount(['students','activities'])->orderBy('code')->paginate(10); return view('courses.index',compact('courses')); }
 public function create(){ return view('courses.create'); }
 public function store(Request $request){ $data=$request->validate(['code'=>'required|string|max:30|unique:courses,code','title'=>'required|string|max:255','credits'=>'required|integer|min:1|max:12']); Course::create($data); return redirect()->route('courses.index')->with('success','Course created successfully.'); }
 public function show(Course $course){ $course->load(['students','activities']); return view('courses.show',compact('course')); }
 public function edit(Course $course){ return view('courses.edit',compact('course')); }
 public function update(Request $request,Course $course){ $data=$request->validate(['code'=>['required','string','max:30',Rule::unique('courses')->ignore($course->id)],'title'=>'required|string|max:255','credits'=>'required|integer|min:1|max:12']); $course->update($data); return redirect()->route('courses.show',$course)->with('success','Course updated successfully.'); }
 public function destroy(Course $course){ $course->delete(); return redirect()->route('courses.index')->with('success','Course and related records deleted.'); }
}
