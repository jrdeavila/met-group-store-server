<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */

    // Test Create a new Store Item
    private function test_endpoint_create_store_item($name = 'TestStore')
    {
        $response = $this->post(route('store.create', $name));
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'name',
            'items'
        ]);

        return $response->json();
    }



    // Test Get Item Collection
    public function test_endpoint_get_item_collection()
    {
        $response = $this->get(route('items.index'));
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(200);
    }

    // Test Create a new Item
    public function test_endpoint_post_item($name = 'TestItem', $storeName = "TestStore")
    {
        $json = $this->test_endpoint_create_store_item($storeName);
        $id = $json['id'];
        $response = $this->post(route('items.create', $name), [
            'price' => 12.4,
            'store_id' => $id
        ]);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(201);
        $response->assertJsonStructure([
            'id',
            'name',
            'price',
            'store_id'
        ]);
        return $response->json();
    }

    public function test_endpoint_post_item_validate_exist()
    {
        $id = $this->test_endpoint_post_item()['id'];
        $response = $this->post(route('items.create', 'TestItem'), [
            'price' => 12.4,
            'store_id' => $id
        ]);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(422);
    }
    public function test_endpoint_post_item_validate_name_field_prohibited()
    {
        $id = $this->test_endpoint_post_item()['id'];
        $response = $this->post(route('items.create', 'TestItem'), [
            'price' => 12.4,
            'store_id' => $id,
            'name' => 'TestItem'
        ]);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(422);
    }


    // Test Get an Item
    public function test_endpoint_get_item()
    {
        $json = $this->test_endpoint_post_item();
        $response = $this->get(route('items.show', $json['name']));
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(200);
    }

    public function test_endpoint_get_item_not_exist()
    {
        $response = $this->get(route('items.show', 'TestItem'));
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(404);
    }

    //Test Update an Item
    public function test_endpoint_update_item_price()
    {
        $json = $this->test_endpoint_post_item();
        $response = $this->put(route('items.update', $json['name']), [
            'price' => 50.22
        ]);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(200);
    }
    public function test_endpoint_update_item_price_invalid_format()
    {
        $json = $this->test_endpoint_post_item();
        $response = $this->put(route('items.update', $json['name']), [
            'price' => "abcdef"
        ]);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(422);
    }
    public function test_endpoint_update_item_name()
    {
        $json = $this->test_endpoint_post_item();
        $response = $this->put(route('items.update', $json['name']), [
            'name' => 'AnotherName'
        ]);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(200);
    }

    public function test_endpoint_update_item_validate_name_exist()
    {
        $json = $this->test_endpoint_post_item();
        $json2 = $this->test_endpoint_post_item('AnotherItem', "AnotherStore");
        $response = $this->put(route('items.update', $json['name']), [
            'name' => $json2["name"]
        ]);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(422);
    }

    public function test_endpoint_update_item_store()
    {
        $json = $this->test_endpoint_post_item();
        $json2 = $this->test_endpoint_create_store_item('AnotherStore');
        $response = $this->put(route('items.update', $json['name']), [
            'store_id' => $json2["id"]
        ]);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(200);
    }

    public function test_endpoint_update_item_store_not_exist()
    {
        $json = $this->test_endpoint_post_item();
        $response = $this->put(route('items.update', $json['name']), [
            'store_id' => 0,
        ]);
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(422);
    }
    // Test Delete an Item
    public function test_endpoint_delete_an_item()
    {
        $json = $this->test_endpoint_post_item();
        $response = $this->delete(route('items.destroy', $json['name']));
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(200);
    }

    public function test_endpoint_delete_an_item_not_found()
    {
        $response = $this->delete(route('items.destroy', 'TestItem'));
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(404);
    }
    // Test Trash an Item
    public function test_endpoint_trash_an_item()
    {
        $json = $this->test_endpoint_post_item();
        $response = $this->put(route('items.trash', $json['name']));
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(200);
        return $json;
    }


    public function test_endpoint_trash_an_item_not_found()
    {
        $response = $this->put(route('items.trash', 'TestItem'));
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(404);
    }

    // Test Restore an Item
    public function test_endpoint_restore_an_item()
    {
        $json = $this->test_endpoint_trash_an_item();
        $response = $this->put(route('items.restore', $json['name']));
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(200);
    }

    public function test_endpoint_restore_an_item_not_trashed()
    {
        $json = $this->test_endpoint_post_item();
        $response = $this->put(route('items.restore', $json['name']));
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(400);
    }
    public function test_endpoint_restore_an_item_not_exist()
    {
        $response = $this->put(route('items.restore', 'TestItem'));
        $response->header('Content-Type', 'application/json');
        $response->assertStatus(404);
    }
}
