<?php

namespace App\Repositories;

use Yish\Generators\Foundation\Repository\Repository;
use App\Classroom;

class ClassRepository
{
    protected $Classroom;

    public function getClassList(int $id)
    {
        try {
            return Classroom::with('students')->findOrFail($id);
            
        } catch (\Exception $e) {
            $err_msg = $e->getMessage();
            return [
                'message' =>$err_msg
            ];
        }
    }

}
