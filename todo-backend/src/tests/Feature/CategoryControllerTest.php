<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Category;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_index_category()
    {
        $item = Category::factory()->create();
        $response = $this->get('/api/v1/category');
        $response->assertStatus(200);
        $response->assertJsonFragment([
        'name' => $item->name,
        
        ]);
    }
    public function test_store_category()
    {
        $data = [
            'name' => 'category',
        
        ];
        $response = $this->post('/api/v1/category', $data);
        $response->assertStatus(201);
        $response->assertJsonFragment($data);
        $this->assertDatabaseHas('categories', $data);
    }
    public function test_show_category()
    {
        $item = Category::factory()->create();
        $response = $this->get('/api/v1/category/' . $item->id);
        $response->assertStatus(200);
        $response->assertJsonFragment([
          'name' => $item->name,
        ]);
    }
    public function test_update_category()
    {
        $item = Category::factory()->create();
        $data = [
          'name' => 'category_update'
        ];
        $response = $this->put('/api/v1/category/' . $item->id, $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', $data);
    }
    public function test_destroy_category()
    {
        $item = Category::factory()->create();
        $response = $this->delete('/api/v1/category/' . $item->id);
        $response->assertStatus(200);
        $this->assertDeleted($item);
    }

}
