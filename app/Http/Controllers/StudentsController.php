<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Requests\StudentCreateRequest;
use App\Student;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Student::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentCreateRequest $request)
    {
        // $name_value = $request->input('name');
        // $email_value = $request->input('email');
        // $age_value = $request->input('age');
        // $insert_data = [
        //     'name' => $name_value,
        //     'email' => $email_value,
        //     'age' => $age_value,
        //     'created_at' => Carbon::now()->toDatetimeString(),
        //     'updated_at' => Carbon::now()->toDatetimeString(),
        // ];
        // DB::table('students')->insert($insert_data);

        // $student = new Student();
        // $student->name = $name_value;
        // $student->email = $email_value;
        // $student->age = $age_value;
        // $student->save();
        $student = Student::create($request->all());
        
        return response()->json($student, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $student = Student::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Not found the student'
            ], 404);
        }
        return $student;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StudentUpdateRequest $request, $id)
    {
        
        try {
            $student = Student::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Not found the student'
            ], 404);
        }
        $student->update($request->all());
        return response($student);
        // $name_value = $request->input('name', $student->name);
        // $email_value = $request->input('email', $student->email);
        // $age_value = $request->input('age', $student->age);

    
        // $student->name = $name_value;
        // $student->email = $email_value;
        // $student->age = $age_value;
        
        
        // $student->save();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $student = Student::findOrFail($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Not found the student'
            ], 404);
        }
        $student->delete();
        return response()->json(null);
    }
}
