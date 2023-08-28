<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Todo;

class TodoControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_todo()
    {
        $items = Todo::factory()->create();
        $response = $this->get('/api/v1/todo');
        $response->assertStatus(200);
        $response->assertJsonFragment([
          'content' => $items->content,
          'category' => $items->category,
        ]);
    }
    public function test_store_todo()
    {
        $data = [
          'content' => 'todo',
          'category' => 'todo',
        ];
        $response = $this->post('/api/v1/todo', $data);
        $response->assertStatus(201);
        $response->assertJsonFragment($data);
        $this->assertDatabaseHas('todos', $data);
    }
    public function test_show_todo()
    {
        $item = Todo::factory()->create();
        $response = $this->get('/api/v1/todo/' . $item->id);
        $response->assertStatus(200);
        $response->assertJsonFragment([
          'content' => $item->content,
          'category' => $item->category,
        ]);
    }
    public function test_update_todo()
    {
        $item = Todo::factory()->create();
        $data = [
          'content' => 'todo_update',
          'category' => 'todo_update',
        
        ];
        $response = $this->put('/api/v1/todo/' . $item->id, $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('todos', $data);
    }
    public function test_destroy_todo()
    {
        $item = Todo::factory()->create();
        $response = $this->delete('/api/v1/todo/' . $item->id);
        $response->assertStatus(200);
        $this->assertDeleted($item);
    }
}
