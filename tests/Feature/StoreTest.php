<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StoreTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // Test Get Store Collection
    public function test_endpoint_get_store_collection()
    {
        $response = $this->get('/api/store');
        $response->header('Content-Type', 'application/json');

        $response->assertStatus(200);
    }

    public function test_endpoint_get_store_item()
    {
        $json = $this->test_endpoint_create_store_item();
        $response = $this->get('/api/store/' . $json['name']);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'items'
        ]);
        return $response->json();
    }
    public function test_endpoint_get_store_not_exist()
    {
        $response = $this->get('/api/store/TestStore');
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(404);
    }

    // Test Create a new Store Item
    public function test_endpoint_create_store_item($name = 'TestStore')
    {
        $response = $this->post('/api/store/' . $name);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'name',
            'items'
        ]);

        return $response->json();
    }

    public function test_endpoint_create_store_validate_exist()
    {
        $json = $this->test_endpoint_create_store_item();
        $response = $this->post('/api/store/' . $json['name']);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(422);
    }

    // Test Update an Store
    public function test_endpoint_update_store_item()
    {
        $json = $this->test_endpoint_create_store_item();
        $response = $this->put('/api/store/' . $json['name'], [
            'name' => 'NewTestStoreName',
        ]);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'items'
        ]);
    }

    public function test_endpoint_update_store_validate_name_exist()
    {
        $json1 =  $this->test_endpoint_create_store_item();
        $json2 = $this->test_endpoint_create_store_item('AnotherTestStore');


        $response = $this->put('/api/store/' . $json1['name'], [
            'name' => $json2['name'],
        ]);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(422);
    }

    public function test_endpoint_update_store_not_exist()
    {
        $response = $this->put('/api/store/TestStore', [
            'name' => 'AnotherTestStore',
        ]);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(404);
    }

    // Test Deleted an Store
    public function test_endpoint_delete_store_item()
    {
        $json = $this->test_endpoint_create_store_item();
        $response = $this->delete('/api/store/' . $json['name']);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(200);
    }

    public function test_endpoint_delete_store_not_found()
    {
        $response = $this->delete('/api/store/TestStore');
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(404);
    }
    // Test Trash an Store
    public function test_endpoint_trash_store_item($name = 'TestStore')
    {
        $json = $this->test_endpoint_create_store_item($name);
        $response = $this->put('/api/store/' . $json['name'] . '/trash');
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(200);
    }
    public function test_endpoint_trash_store_not_exist()
    {
        $response = $this->put('/api/store/TestStore/trash');
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(404);
    }

    // Test Restore an Store
    public function test_endpoint_restore_an_store_item($name = 'TestStore')
    {
        $this->test_endpoint_trash_store_item($name);
        $response = $this->put('/api/store/' . $name . '/restore');
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'id',
            'name',
            'items'
        ]);
    }
    public function test_endpoint_restore_an_store_validate_trashed()
    {
        $json = $this->test_endpoint_create_store_item();

        $response = $this->put('/api/store/' . $json['name'] . '/restore');
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(400);
    }
    public function test_endpoint_restore_an_store_not_exist()
    {
        $response = $this->put('/api/store/TestStore/restore');
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(404);
    }
}
