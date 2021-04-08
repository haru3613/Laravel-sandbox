<?php

use Illuminate\Http\Request;
use App\Classroom;

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

Route::post('/student', 'StudentsController@store')->name('create_student');
Route::get('/student', 'StudentsController@index')->name('get_student');
Route::get('/class/{id}', 'ClassController@show')->name('get_specific_classroom_student');
// Route::get('/student', function (Request $request) {
//     $student_id = $request->input('student_id');
//     $student_orm = Student::all();
    
//     $student_builder = DB::table('students')->get();
//     dd($student_builder->toArray(), data_get($student_builder->toArray(), '0.name'));
//     dd($student_orm->toArray());
// });
Route::get('/student/{id}', 'StudentsController@show')->name('get_specific_student');
Route::delete('/student/{id}', 'StudentsController@destroy')->name('delete_student');
Route::put('/student/{id}', 'StudentsController@update')->name('update_student');

Route::get('/test', function() {
    $class = Classroom::find(1);
    dd($class->name);
});