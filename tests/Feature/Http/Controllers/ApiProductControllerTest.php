<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * test route GET /api/products
     *
     * @return void
     */
    public function test_index()
    {
        Product::factory(30)->create();

        $response = $this->getJson('/api/products?page=2&per_page=5');

        $response->assertJsonStructure([
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'description',
                    'price',
                    'created_at',
                    'updated_at',
                ],
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links' => ['*' => ['active', 'label', 'url']],
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total',
        ]);

        $response->assertJsonFragment([
            'current_page' => 2,
            'per_page' => 5,
            'to' => 10,
            'total' => 30,
        ]);

        $response->assertJsonCount(5, 'data');

        $response->assertOk();
    }

    /**
     * test route POST /api/products
     *
     * @return void
     */
    public function test_store()
    {
        $response = $this->postJson('/api/products', [
            'name' => 'Example',
            'description' => 'Example Description',
            'price' => 1234.5,
        ]);

        $response->assertJsonStructure([
            'message',
            'data' => [
                'product' => [
                    'id',
                    'name',
                    'description',
                    'created_at',
                    'updated_at',
                ],
            ],
        ]);

        $response->assertCreated();

        $this->assertDatabaseCount('products', 1);

        /**
         * handling validation
         */

        $response = $this->postJson('/api/products', [
            //
        ]);

        $response->assertJsonStructure([
            'message',
            'errors' => ['name', 'description', 'price'],
        ]);

        $response->assertUnprocessable();
    }

    /**
     * test route GET /api/products/{product}
     *
     * @return void
     */
    public function test_show()
    {
        $product = Product::create([
            'name' => 'Example',
            'description' => 'Example description',
            'price' => 1234.56,
        ]);

        $response = $this->getJson("/api/products/{$product->id}");

        $response->assertJson(
            [
                'name' => 'Example',
                'description' => 'Example description',
                'price' => '1234.56',
            ],
            true
        );

        /**
         * not found response
         */

        $response = $this->getJson('/api/products/2');

        $response->assertNotFound();
    }

    /**
     * test route PATCH|PUT /api/products/{product}
     *
     * @return void
     */
    public function test_update()
    {
        $product = Product::create([
            'name' => 'Example',
            'description' => 'Example description',
            'price' => 1234.56,
        ]);

        $response = $this->patchJson("/api/products/{$product->id}", [
            'name' => 'Example Updated',
            'price' => 1234.5,
        ]);

        $response->assertNoContent();

        $this->assertDatabaseMissing('products', [
            'name' => 'Example',
            'price' => 1234.56,
        ]);

        $this->assertDatabaseHas('products', [
            'name' => 'Example Updated',
            'price' => 1234.5,
        ]);

        $this->assertDatabaseCount('products', 1);
    }

    /**
     * test route POST /api/products/{product}
     *
     * @return void
     */
    public function test_destroy()
    {
        $product = Product::create([
            'name' => 'Example',
            'description' => 'Example description',
            'price' => 1234.56,
        ]);

        $this->assertDatabaseCount('products', 1);

        $response = $this->deleteJson("/api/products/{$product->id}");

        $response->assertNoContent();

        $this->assertDatabaseCount('products', 0);

        /**
         * not found response
         */

        $response = $this->deleteJson('/api/products/2');

        $response->assertNotFound();
    }
}
