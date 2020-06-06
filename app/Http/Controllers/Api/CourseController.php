<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
// use App\Requests\CourseRequest;
use App\Course;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Jobs\CreateCoursesJob;
use Carbon\Carbon;
use App\Http\Resources\Course as CourseResource;
use App\Exports\CoursesExport;
use Maatwebsite\Excel\Facades\Excel;

class CourseController extends Controller
{
    public function massCreate(){
        
        $authenticateUser = $this->authenticateUser();
        if(!$authenticateUser){
            return response()->json(['success' => false, 'message' => "Invalid Token"]);        
        }
        // get current user's id
        $id = auth()->user()->id;
        $job = (new CreateCoursesJob($id))
                ->delay(Carbon::now()->addSeconds(10));
        dispatch( $job );

        return response()->json(['success' => true, 'message' => "Records created successfully"]);        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    // public function store(Questionnaire $questionnaire){
    //     $data = request()->validate([
    //         'question.question'=>'required|min:3',
    //         'answers.*.answer'=>'required'
    //     ]);
        
    //     $question = $questionnaire->questions()->create($data['question']);
    public function store(Course $Course)
    {
        $authenticateUser = $this->authenticateUser();
        if(!$authenticateUser){
            return response()->json(['success' => false, 'message' => "Invalid Token"]);        
        }
        
        $courses = request()['courses'];

        if(!$courses){
            return response()->json(['success' => false, 'message' => "Parameter cannot be empty"], 400);        
        }
        
        $rules = [
            'course_title' => 'required|string|max:255',
            'course_code' => 'required|string|max:255',
            'course_description' => 'nullable|min:3|max:1000',
        ];    

        //ensure all courses are valid
        foreach($courses as $value){
            $validator = Validator::make($value, $rules);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'error' => $validator->messages()]);
            }
        }
        
        $created = $authenticateUser->courses()->createMany($courses);
        if(!$created){
            return response()->json(['success' => false, 'error' => "Unable to create record(s)"]);
        }
        return response()->json(['success' => true, 'message' => "Record(s) created successfully!"]);
    }

    public function getAll()
    {
        $authenticateUser = $this->authenticateUser();
        if(!$authenticateUser){
            return response()->json(['success' => false, 'message' => "Invalid Token"]);        
        }
        return CourseResource::collection(Course::all());
    }

    public function exportAll(){

        $authenticateUser = $this->authenticateUser();
        if(!$authenticateUser){
            return response()->json(['success' => false, 'message' => "Invalid Token"]);        
        }
        
        return Excel::download(new CoursesExport(), 'courses.csv');
    }

}
