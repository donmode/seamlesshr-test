<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Database\Seeds\CourseSeeder;
use App\Course;

class Course extends Model
{
    protected $fillable = ['user_id', 'course_title', 'course_code','course_description'];
 
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function createMassCourses($id){
        // $seeder = new \Database\Seeds\CourseSeeder();
        // return $seeder->run();

        factory(Course::class, 50)->create([
            'user_id' => $id,
        ]);
    }
}
