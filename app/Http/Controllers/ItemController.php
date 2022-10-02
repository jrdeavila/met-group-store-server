<?php

namespace App\Http\Controllers;

use App\Http\Requests\ItemRequest;
use App\Interfaces\Items\ItemServiceInterface;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    private ItemServiceInterface $service;

    // Dependency-Inversion
    public function __construct(ItemServiceInterface $service)
    {
        $this->service = $service;
    }

    // Endpoint to get item collection paginated
    public function index()
    {
        return $this->service->get();
    }

    // Endpoint to create an item  
    public function store(string $name, ItemRequest $request)
    {
        return $this->service->post($name, $request);
    }

    // Endpoint to display an item
    public function show(string $name)
    {
        return $this->service->show($name);
    }

    // Endpoint to force-delete an item 
    public function destroy(string $name)
    {
        return $this->service->delete($name);
    }

    // Endpoint to update an item
    public function update(string $name, ItemRequest $request)
    {
        return $this->service->update($name, $request);
    }
}
