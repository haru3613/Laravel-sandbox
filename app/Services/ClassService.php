<?php

namespace App\Services;

use Yish\Generators\Foundation\Service\Service;
use App\Repositories\ClassRepository;

class ClassService
{
    protected $class_repository;

    public function __construct(ClassRepository $class_repository)
    {
        $this->class_repository = $class_repository;
    }

    public function handleGetClassList(int $id)
    {
        $result = $this->class_repository->getClassList($id);
        
        return $result;
    }
}
