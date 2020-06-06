<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Course;
use Faker\Generator as Faker;

$factory->define(\App\Course::class, function (Faker $faker) {
    return [
        'user_id' => 1, //sets default user_id as one
        'course_title'=>$faker->unique()->sentence,
        'course_code'=>$faker->unique()->word,
        'course_description'=>$faker->paragraph
    ];
});
