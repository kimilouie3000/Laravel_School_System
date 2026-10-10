<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder; use App\Models\Student; use App\Models\Course; use App\Models\Activity;
class DatabaseSeeder extends Seeder { public function run(): void {
 $web=Course::firstOrCreate(['code'=>'WEB201'],['title'=>'Web Systems and Technologies','credits'=>3]);
 $db=Course::firstOrCreate(['code'=>'DB101'],['title'=>'Database Management','credits'=>3]);
 $student=Student::firstOrCreate(['student_number'=>'2026-0001'],['first_name'=>'Alex','last_name'=>'Santos','email'=>'alex.santos@example.com','date_of_birth'=>'2005-04-12']);
 $student->courses()->syncWithoutDetaching([$web->id=>['enrolled_at'=>now()->toDateString()],$db->id=>['enrolled_at'=>now()->toDateString()]]);
 Activity::firstOrCreate(['course_id'=>$web->id,'title'=>'Personal Portfolio Website'],['description'=>'Create a simple personal portfolio website and submit the link or a short description of your work.','max_points'=>100,'due_date'=>now()->addDays(7)]);
} }
