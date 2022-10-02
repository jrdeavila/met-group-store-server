<?php

namespace App\Http\Controllers;

use App\Interfaces\IStoreService;
use Illuminate\Http\Request;

class StoreRestoreController extends Controller
{
    public function __invoke(string $name, IStoreService $service)
    {
        return $service->restore($name);
    }
}
