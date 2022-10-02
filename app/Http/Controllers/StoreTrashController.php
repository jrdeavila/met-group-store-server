<?php

namespace App\Http\Controllers;

use App\Interfaces\Stores\StoreServiceInterface;

class StoreTrashController extends Controller
{
    public function __invoke(string $name, StoreServiceInterface $service)
    {
        return $service->trash($name);
    }
}
