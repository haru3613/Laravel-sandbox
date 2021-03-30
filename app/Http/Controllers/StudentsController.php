<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Requests\StudentUpdateRequest;
use App\Http\Requests\StudentCreateRequest;
use App\Services\StudentService;

class StudentsController extends Controller
{
    /**
     * @var 商業邏輯層
     */
    protected $student_service;

    public function __construct(StudentService $student_service)
    {
        $this->student_service = $student_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = $this->student_service->handleGetStudentList();

        return response()->json([
            'code' =>  'e0000',
            'result' => $result
        ]);
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
        $result = $this->student_service->handleCreateStudent($request->all());
        
        return response()->json([
            'code' =>  'e0000',
            'result' => $result
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->student_service->handleGetSpecificStudent($id);
       
        return response()->json([
            'code' =>  'e0000',
            'result' => $result
        ]);
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
        $result = $this->student_service->handleUpdateStudent($request->all(), $id);

        return response()->json([
            'code' =>  'e0000',
            'result' => $result
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->student_service->handleDeleteStudent($id);

        return response()->json([
            'code' =>  'e0000',
            'result' => $result
        ]);
    }
}
