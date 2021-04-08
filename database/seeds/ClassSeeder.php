<?php

use Illuminate\Database\Seeder;
use App\Classroom;

class ClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $class = factory(Classroom::class, 5)->create();
    }
}
