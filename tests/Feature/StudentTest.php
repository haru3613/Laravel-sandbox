<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Student;
use Tests\TestCase;
use Illuminate\Support\Str;

class StudentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    
    public function testGetStudentList()
    {
        $student = factory(Student::class, 5)->create();
        $response = $this->get('/api/student');
        $response->assertStatus(200);
    }

    public function testCreateStudent()
    {
        $response = $this->json('POST', '/api/student',[
            'name' => 'tester',
            'email' => 'tester@talfin.ai',
            'age' => 99
        ]);

        $response->assertStatus(200);
        $actual = $response->decodeResponseJson();
        $this->assertArrayHasKey('code', $actual);
        $this->assertArrayHasKey('name', $actual['result']);
        $this->assertArrayHasKey('email', $actual['result']);
        $this->assertArrayHasKey('age', $actual['result']);
        $this->assertArrayHasKey('updated_at', $actual['result']);
        $this->assertArrayHasKey('created_at', $actual['result']);
        $this->assertArrayHasKey('id', $actual['result']);
    }

    public function testCreateStudentWithInvalidPayloads()
    {
        $response = $this->json('POST', '/api/student',[
            'name' => Str::random(101),
            'email' => Str::random(101),
            'age' => 101
        ]);

        $response->assertStatus(422);
        $actual = $response->decodeResponseJson();
        $this->assertEquals('The name may not be greater than 100 characters.', $actual['errors']['name'][0]);
        $this->assertEquals('The email may not be greater than 100 characters.', $actual['errors']['email'][0]);
        $this->assertEquals('The age may not be greater than 100.', $actual['errors']['age'][0]);
    }

    public function testGetSpecificStudent()
    {
        $student = factory(Student::class)->create();
        $response = $this->get(sprintf('/api/student/%s', $student->id));
        $response->assertStatus(200);
    }

    public function testUpdateStudent()
    {
        $student = factory(Student::class)->create();
        $response = $this->json('PUT', sprintf('/api/student/%s', $student->id),[
            'name' => 'updated',
            'email' => 'updated@talfin.ai',
            'age' => 99
        ]);
        $response->assertStatus(200);
        $actual = $response->decodeResponseJson();
        $this->assertArrayHasKey('code', $actual);
        $this->assertArrayHasKey('name', $actual['result']);
        $this->assertArrayHasKey('email', $actual['result']);
        $this->assertArrayHasKey('age', $actual['result']);
        $this->assertArrayHasKey('updated_at', $actual['result']);
        $this->assertArrayHasKey('created_at', $actual['result']);
        $this->assertArrayHasKey('id', $actual['result']);
    }

    public function testUpdateStudentWithInvalidPayloads()
    {
        $student = factory(Student::class)->create();
        $response = $this->json('PUT', sprintf('/api/student/%s', $student->id),[
            'name' => Str::random(101),
            'email' => Str::random(101),
            'age' => 101
        ]);

        $response->assertStatus(422);
        $actual = $response->decodeResponseJson();
        $this->assertEquals('The name may not be greater than 100 characters.', $actual['errors']['name'][0]);
        $this->assertEquals('The email may not be greater than 100 characters.', $actual['errors']['email'][0]);
        $this->assertEquals('The age may not be greater than 100.', $actual['errors']['age'][0]);
    }

    public function testDeleteStudent()
    {
        $student = factory(Student::class)->create();
        $response = $this->delete(sprintf('/api/student/%s', $student->id));
        $response->assertStatus(200);

        $actual = $response->decodeResponseJson();
        $this->assertArrayHasKey('code', $actual);
        $this->assertEquals([], $actual['result']);
    }
}
