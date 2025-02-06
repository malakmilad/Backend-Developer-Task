<?php
namespace Tests\Feature;

use Tests\TestCase;

class TaskTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_task_creation(): void
    {
        $user = \App\Models\User::factory()->create([
            'name'     => 'malak',
            'email'    => 'malak@gmail.com',
            'password' => '12345678',
        ]);

        $token = $user->createToken('token')->plainTextToken;

        $taskData = [
            'name'        => 'Test Task',
            'description' => 'Task description',
            'status'      => 'pending',
        ];

        $response = $this->postJson('/api/tasks', $taskData, [
            'Authorization' => 'Bearer ' . $token,
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', ['name' => 'Test Task']);
    }

}
