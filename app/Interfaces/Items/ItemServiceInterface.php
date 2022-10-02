<?php

namespace App\Interfaces\Items;

use App\Http\Requests\ItemRequest;

interface ItemServiceInterface
{
  public function get(): ItemCollectionInterface;
  public function show(string $name): ItemResourceInterface;
  public function post(string $name, ItemRequest $request): ItemResourceInterface;
  public function delete(string $name): ItemDeletedMessageInterface;
  public function restore(string $name): ItemResourceInterface;
  public function update(string $name, ItemRequest $request): ItemResourceInterface;
  public function trash(string $name): ItemTrashedMessageInterface;
}
