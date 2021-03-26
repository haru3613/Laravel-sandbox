<?php

use Illuminate\Http\Request;
use App\Student;
use Illuminate\Support\Facades\DB;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create_student', 'StudentsController@store')->name('create_student');
Route::get('/get_student', function (Request $request) {
    $student_id = $request->input('student_id');
    $student_orm = Student::all();
    
    $student_builder = DB::table('students')->get();
    dd($student_builder->toArray(), data_get($student_builder->toArray(), '0.name'));
    dd($student_orm->toArray());
});