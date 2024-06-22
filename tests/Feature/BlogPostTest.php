<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogPostTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_getblogposts() {     
        // Assert that a record exists in the "posts" table     
        $this->assertDatabaseHas('posts', 
          [
            'email' => 'test@example.com',
          ]); 
      }
}
