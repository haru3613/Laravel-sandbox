<?php

namespace App\Services;

use App\Repositories\StudentRepository;
use Yish\Generators\Foundation\Service\Service;

class StudentService
{
    protected $student_repository;

    /**
     * StudentService constructor.
     *
     * @param StudentRepository $student_repository
     */
    public function __construct(StudentRepository $student_repository)
    {
        $this->student_repository = $student_repository;
    }

    /**
     * 取得學生名單
     *
     * @return mixed
     */
    public function handleGetStudentList()
    {
        $result_data = [];
        $result = $this->student_repository->getStudentList();
        foreach ($result as $data) {
            array_push($result_data, [
                'id' => $data->id,
                'name' => $data->name
            ]);
        }
        return $result_data;
    }

    /**
     * 新增學生資料
     *
     * @return mixed
     */
    public function handleCreateStudent(array $request_data)
    {
        
        $result = $this->student_repository->createStudent($request_data);
        
        return $result;
    }

    /**
     * 取得特定學生資料
     *
     * @param integer $id
     * @return mixed
     */
    public function handleGetSpecificStudent(int $id)
    {
        $result = $this->student_repository->getSpecificStudent($id);
        
        return $result;
    }

    /**
     * 更新特定學生資料
     *
     * @param array $request
     * @param integer $id
     * @return mixed
     */
    public function handleUpdateStudent(array $request, int $id)
    {
        $result = $this->student_repository->updateStudent($request, $id);
        
        return $result;
    }

    /**
     * 刪除特定學生資料
     *
     * @param integer $id
     * @return mixed
     */
    public function handleDeleteStudent(int $id)
    {
        $result = $this->student_repository->deleteStudent($id);
        
        return $result;
    }
    
}
