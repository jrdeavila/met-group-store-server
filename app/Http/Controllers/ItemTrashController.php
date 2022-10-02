<?php

namespace App\Http\Controllers;

use App\Interfaces\Items\ItemServiceInterface;

class ItemTrashController extends Controller
{
    public function __invoke(string $name, ItemServiceInterface $service)
    {
        return $service->trash($name);
    }
}
