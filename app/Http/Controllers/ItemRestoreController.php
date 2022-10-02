<?php

namespace App\Http\Controllers;

use App\Interfaces\Items\ItemServiceInterface;

class ItemRestoreController extends Controller
{
    public function __invoke(string $name, ItemServiceInterface $service)
    {
        return $service->restore($name);
    }
}
