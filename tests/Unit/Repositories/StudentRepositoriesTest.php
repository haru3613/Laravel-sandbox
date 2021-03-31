<?php

namespace Tests\Unit\Repositories;

// use PHPUnit\Framework\TestCase;
use App\Student;
use App\Repositories\StudentRepository;
use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StudentRepositoriesTest extends TestCase
{

    use RefreshDatabase;

    protected $student_repository;
    protected $faker;

    /**
     * 在每個 test case 開始前執行.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->student_repository = app()->make(StudentRepository::class);
        $this->faker = app()->make(Faker::class);
    }

    public function testGetStudentList()
    {
        $student = factory(Student::class, 5)->create();
        $result = $this->student_repository->getStudentList();
        foreach ($result as $item) {
            $this->assertDatabaseHas('students', [
                'id' => $item->id,
                'name' => $item->name,
            ]);
        }
        $this->assertCount(5, $result);
    }

    public function testCreateStudent()
    {
        $fake_data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'age' => rand(0, 100),
        ];
        $result = $this->student_repository->createStudent($fake_data);
        $this->assertDatabaseHas('students', [
            'name' => $fake_data['name'],
            'email' => $fake_data['email'],
            'age' => $fake_data['age'],
        ]);
        $this->assertCount(1, Student::all());
    }

    public function testGetSpecificStudent()
    {
        $student = factory(Student::class)->create();
        $result = $this->student_repository->getSpecificStudent($student->id);
        
        $this->assertNotNull($result);
        $this->assertDatabaseHas('students', [
            'name' => $result->name,
            'email' => $result->email,
            'age' => $result->age,
        ]);
    }

    public function testGetNotExistedStudent()
    {
        $result = $this->student_repository->getSpecificStudent(1);
        $this->assertArrayHasKey('message', $result);
    }

    public function testUpdateStudent() {
        $student = factory(Student::class)->create();
        $fake_data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'age' => rand(0, 99)
        ];
        $result = $this->student_repository->updateStudent($fake_data, $student->id);
        $this->assertDatabaseHas('students', [
            'id' => $student->id,
            'name' => $fake_data['name'],
            'email' => $fake_data['email'],
            'age' => $fake_data['age'],
        ]);

    }

    public function testUpdateNotExistedStudent() {
        $fake_data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'age' => rand(0, 99)
        ];
        $result = $this->student_repository->updateStudent($fake_data, 1);
        $this->assertArrayHasKey('message', $result);

    }

    public function testDeleteStudent() {
        $student = factory(Student::class)->create();
        $result = $this->student_repository->deleteStudent($student->id);
        $this->assertCount(0, Student::all());
    }

    public function testDeleteNotExistedStudent() {
        $result = $this->student_repository->deleteStudent(1);
        $this->assertArrayHasKey('message', $result);
    }
}
