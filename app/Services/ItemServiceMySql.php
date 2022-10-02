<?php

namespace App\Services;

use App\Exceptions\Item\ItemExistException;
use App\Exceptions\Item\ItemNotFoundException;
use App\Exceptions\Item\ItemNotTrashedException;
use App\Http\Messages\Item\ItemDeletedMessage;
use App\Http\Messages\Item\ItemTrashedMessage;
use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemCollection;
use App\Http\Resources\ItemResource;
use App\Interfaces\Items\ItemCollectionInterface;
use App\Interfaces\Items\ItemDeletedMessageInterface;
use App\Interfaces\Items\ItemResourceInterface;
use App\Interfaces\Items\ItemServiceInterface;
use App\Interfaces\Items\ItemTrashedMessageInterface;
use App\Models\Item;

class ItemServiceMySql implements ItemServiceInterface
{
  private function checkIfItemExist(string $name): bool
  {
    $r = Item::where('name', $name)->first();
    return $r ? true : false;
  }

  private function findItemByName(string $name): Item
  {
    $r = Item::whereRaw('BINARY name = ?', $name)->first();
    throw_unless($r, ItemNotFoundException::class);
    return $r;
  }

  private function findItemTrashedByName(string $name): Item
  {
    $r = Item::whereRaw('BINARY name = ?', $name)->withTrashed()->first();
    throw_unless($r, ItemNotFoundException::class);
    return $r;
  }

  public function get(): ItemCollectionInterface
  {
    return new ItemCollection(Item::all());
  }

  public function post(string $name, ItemRequest $request): ItemResourceInterface
  {
    $exist = $this->checkIfItemExist($name);
    \throw_unless(!$exist, ItemExistException::class);
    $item = Item::create([
      'name' => $name,
      ...$request->all(),
    ]);
    return new ItemResource($item);
  }

  public function delete(string $name): ItemDeletedMessageInterface
  {
    $item = $this->findItemByName($name);
    $item->forceDelete();
    return new ItemDeletedMessage();
  }

  public function update(string $name, ItemRequest $request): ItemResourceInterface
  {
    $item = $this->findItemByName($name);
    $newName = $request->get('name');
    if ($newName && $this->checkIfItemExist($newName) && $newName != $name) throw new ItemExistException();
    $item->update($request->all());
    return new ItemResource($item);
  }

  public function trash(string $name): ItemTrashedMessageInterface
  {
    $item = $this->findItemByName($name);
    $item->delete();
    return new ItemTrashedMessage();
  }

  public function restore(string $name): ItemResourceInterface
  {
    $item = $this->findItemTrashedByName($name);
    \throw_unless($item->trashed(), ItemNotTrashedException::class);
    $item->restore();
    return new ItemResource($item);
  }

  public function show(string $name): ItemResourceInterface
  {
    $item = $this->findItemByName($name);
    return new ItemResource($item);
  }
}
