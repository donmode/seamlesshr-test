<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Login Route
Route::post('/login', [
    'as'=>'api.login',
    'uses'=>'Api\Auth\LoginController@login'
]);

//Register Route
Route::post('/register', [
    'as'=>'api.register',
    'uses'=>'Api\Auth\RegisterController@register'
]);

//Mass - Create Courses Route
Route::get('/courses/mass-create', [
    'as'=>'api.courses.mass-create',
    'uses'=>'Api\CourseController@massCreate'
]);


//Get - All Courses Route
Route::get('/courses/get-all', [
    'as'=>'api.courses.get-all',
    'uses'=>'Api\CourseController@getAll'
]);

//Register One or More Courses Route
Route::post('/courses/register', [
    'as'=>'api.courses.register',
    'uses'=>'Api\CourseController@store'
]);

//Export All Courses Route
Route::get('/courses/export-all', [
    'as'=>'api.courses.export-all',
    'uses'=>'Api\CourseController@exportAll'
]);