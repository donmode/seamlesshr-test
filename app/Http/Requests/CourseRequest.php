<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        'user_id' => 'required|exists:users,id',
        'course_title' => 'required|string|max:255',
        'course_code' => 'required|string|max:255',
        'course_description' => 'nullable|min:3|max:1000',
    ];
    }
}
