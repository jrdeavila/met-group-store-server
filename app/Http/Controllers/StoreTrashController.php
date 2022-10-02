<?php

namespace App\Http\Controllers;

use App\Interfaces\IStoreService;

class StoreTrashController extends Controller
{
    public function __invoke(string $name, IStoreService $service)
    {
        return $service->trash($name);
    }
}
