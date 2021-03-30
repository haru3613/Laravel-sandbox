<?php

namespace App\Repositories;

use App\Student;
use Yish\Generators\Foundation\Repository\Repository;

class StudentRepository
{
    // protected $model;
    /**
     * 取得學生名單
     *
     * @return mixed
     */
    public function getStudentList()
    {
        try {
            return Student::all();
        } catch (\Exception $e) {
            $err_msg = $e->getMessage();
            return [
                'message' =>$err_msg
            ];
        }
    }

    /**
     * 新增學生資料
     *
     * @param array $data
     * @return mixed
     */
    public function createStudent(array $data)
    {
        try {
            $student = Student::create($data);
            return $student;
        } catch (\Exception $e) {
            $err_msg = $e->getMessage();
            return [
                'message' =>$err_msg
            ];
        }
    }

    /**
     * 取得特定學生資料
     *
     * @param integer $id
     * @return mixed
     */
    public function getSpecificStudent(int $id)
    {
        try {
            $student = Student::findOrFail($id);
            return $student;
        } catch (\Exception $e) {
            $err_msg = $e->getMessage();
            return [
                'message' =>$err_msg
            ];
        }
    }

    /**
     * 更新特定學生資料
     *
     * @param array $request
     * @param integer $id
     * @return mixed
     */
    public function updateStudent(array $request, int $id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->update($request);
            return $student;
        } catch (\Exception $e) {
            $err_msg = $e->getMessage();
            return [
                'message' =>$err_msg
            ];
        }
    }

    /**
     * 刪除特定學生資料
     *
     * @param integer $id
     * @return mixed
     */
    public function deleteStudent(int $id)
    {
        try {
            $student = Student::findOrFail($id);
            $student->delete();
            return [];
        } catch (\Exception $e) {
            $err_msg = $e->getMessage();
            return [
                'message' =>$err_msg
            ];
        }
    }
    
}
