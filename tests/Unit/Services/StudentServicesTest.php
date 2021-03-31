<?php

namespace Tests\Unit\Services;

// use PHPUnit\Framework\TestCase;
use App\Student;
use App\Services\StudentService;
use App\Repositories\StudentRepository;
use Tests\TestCase;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;

class StudentServicesTest extends TestCase
{

    use RefreshDatabase;

    protected $student_service;
    protected $student_repository_mock;
    protected $faker;

    /**
     * 在每個 test case 開始前執行.
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->student_repository_mock = Mockery::mock(StudentRepository::class);
        $this->faker = app()->make(Faker::class);
        $this->student_service = new StudentService($this->student_repository_mock);
    }

    public function testHandleGetStudentList()
    {
        $this->student_repository_mock
            ->shouldReceive('GetStudentList')
            ->andReturn(factory(Student::class, 2)->make([
                "id" => rand(1, 10),
                "name" => $this->faker->name,
            ]));
        $result = $this->student_service->handleGetStudentList();
        
        $this->assertIsArray($result);
        foreach ($result as $item) {
            $this->assertArrayHasKey('id', $item);
            $this->assertArrayHasKey('name', $item);
        }
    }

    public function testHandleGetStudentListWhenDataNotFound()
    {
       
        $this->student_repository_mock
            ->shouldReceive('GetStudentList')
            ->andReturn([]);
        $result = $this->student_service->handleGetStudentList();
        $this->assertArrayHasKey('code', $result);
        $this->assertArrayHasKey('message', $result);
        
    }

    public function testHandleCreateStudent()
    {
        $expected_data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'age' => rand(0, 100),
        ];
        $this->student_repository_mock
            ->shouldReceive('createStudent')
            ->with($expected_data)
            ->andReturn(factory(Student::class)->make([
                'name' => $expected_data['name'],
                'email' => $expected_data['email'],
                'age' => $expected_data['age'],
            ]));
        $result = $this->student_service->handleCreateStudent($expected_data);

        $this->assertEquals($expected_data, $result->toArray());
    }

    public function testHandleGetSpecificStudent()
    {
        $expected_data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'age' => rand(0, 100),
        ];
        $this->student_repository_mock
            ->shouldReceive('getSpecificStudent')
            ->with(1)
            ->andReturn(factory(Student::class)->make([
                'name' => $expected_data['name'],
                'email' => $expected_data['email'],
                'age' => $expected_data['age'],
            ]));
        $result = $this->student_service->handleGetSpecificStudent(1);
        $this->assertEquals($expected_data, $result->toArray());
    }

    public function testHandleUpdateStudent() {
        $expected_data = [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'age' => rand(0, 99)
        ];
        $this->student_repository_mock
            ->shouldReceive('updateStudent')
            ->with($expected_data, 1)
            ->andReturn(factory(Student::class)->make([
                'name' => $expected_data['name'],
                'email' => $expected_data['email'],
                'age' => $expected_data['age'],
            ]));
        $result = $this->student_service->handleUpdateStudent($expected_data, 1);
        $this->assertEquals($expected_data, $result->toArray());

    }

    public function testHandleDeleteStudent() {
        $this->student_repository_mock
            ->shouldReceive('deleteStudent')
            ->with(1)
            ->andReturn([]);
        $result = $this->student_service->handleDeleteStudent(1);
        $this->assertEquals([], $result);
    }
}
