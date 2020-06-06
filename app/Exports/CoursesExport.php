<?php

namespace App\Exports;

use App\Course;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CoursesExport implements FromQuery, WithHeadings
{
    
    public function query()
    {
        return Course::select('course_title','course_code','course_description');
    }

    public function headings():array
    {
        return [
            'Course Title',
            'Course Code',
            'Course Description'
        ];
    }
}
