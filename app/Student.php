<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";

    protected $fillable = ['name', 'email', 'age'];

    public function classrooms()
    {
        return $this->hasOne('App\Classroom', 'id', 'class_id');
    }
}
