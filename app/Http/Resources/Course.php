<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class Course extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'course_title' => $this->course_title,
            'course_code' => $this->course_code,
            'course_description' => $this->course_description,
            'created_at' => $this->when(Auth::user()->id == $this->user_id, $this->created_at->format('Y-m-d')),
        ];
    }
}
