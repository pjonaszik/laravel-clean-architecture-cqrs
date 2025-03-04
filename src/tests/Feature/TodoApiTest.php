<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Todo\Infrastructure\Models\TodoModel;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TodoApiTest extends TestCase
{
    use DatabaseTransactions;

    public function setUp(): void
    {
        parent::setUp();
        config(['app.url' => env('APP_URL')]);
        $this->artisan('migrate');
    }

    public function test_create_todo(): void
    {
        $todoData = TodoModel::factory()->make()->toArray();

        $response = $this->postJson('/api/v1/todos', $todoData);
        $response
            ->assertStatus(200)
            ->assertJsonPath('title', $todoData['title']);
        $this->assertDatabaseHas('todos', ['title' => $todoData['title']]);
    }

    public function test_retrieve_todo(): void
    {
        $todo = TodoModel::factory()->create();
        $response = $this->getJson("/api/v1/todos/{$todo->id}");
        $response->assertStatus(200)
            ->assertJsonPath('id', $todo->id);
    }

    public function test_update_todo(): void
    {
        $todo = TodoModel::factory()->create();

        $updateData = [
            'title' => 'Updated Task',
            'description' => 'Updated description',
            'due_date' => now()->addDays(30)->toDateString(),
            'completed' => true,
        ];

        $response = $this->putJson("/api/v1/todos/{$todo->id}", $updateData);

        $response->assertStatus(200)
            ->assertJsonPath('title', 'Updated Task')
        ;

        $this->assertDatabaseHas('todos', ['id' => $todo->id, ...$updateData]);
    }

    public function test_delete_todo(): void
    {
        $todo = TodoModel::factory()->create();

        $response = $this->deleteJson("/api/v1/todos/{$todo->id}");

        $response->assertStatus(204);
        $this->assertDatabaseMissing('todos', ['id' => $todo->id]);
    }
}
