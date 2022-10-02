<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Interfaces\Stores\StoreServiceInterface;
use Illuminate\Http\Request;

class StoreController extends Controller
{

    private StoreServiceInterface $service;

    // Dependecy-Inversion
    public function __construct(StoreServiceInterface $service)
    {
        $this->service = $service;
    }

    // Endpoint to get store collection paginated
    public function index()
    {
        return $this->service->get();
    }

    // Endpoint to create an store  
    public function store(string $name)
    {
        return $this->service->post($name);
    }

    // Endpoint to display an store
    public function show(string $name)
    {
        return $this->service->show($name);
    }

    // Endpoint to force-delete an store
    public function destroy(string $name)
    {
        return $this->service->delete($name);
    }

    // Endpoint to update and store
    public function update(string $name, StoreRequest $request)
    {
        return $this->service->update($name, $request);
    }
}
