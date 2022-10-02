<?php

namespace App\Http\Controllers;

use App\Interfaces\Stores\StoreServiceInterface;
use Illuminate\Http\Request;

class StoreRestoreController extends Controller
{
    public function __invoke(string $name, StoreServiceInterface $service)
    {
        return $service->restore($name);
    }
}
