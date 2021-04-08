<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public $timestamps = false;
    
    protected $fillable = ['name'];


    

    public function students()
    {
        return $this->hasMany('App\Student', 'class_id', 'id');
    }
}
