<?php

namespace App\Services;

use App\Exceptions\Store\StoreExistException;
use App\Exceptions\Store\StoreNotFoundException;
use App\Exceptions\Store\StoreNotTrashedException;
use App\Http\Messages\Store\StoreDeletedMessage;
use App\Http\Messages\Store\StoreTrashedMessage;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\StoreCollection;
use App\Http\Resources\StoreResource;
use App\Interfaces\Stores\StoreCollectionInterface;
use App\Interfaces\Stores\StoreDeletedMessageInterface;
use App\Interfaces\Stores\StoreResourceInterface;
use App\Interfaces\Stores\StoreServiceInterface;
use App\Interfaces\Stores\StoreTrashedMessageInterface;
use App\Models\Store;

class StoreServiceMySql implements StoreServiceInterface
{
  private function checkIfStoreExist(string $name)
  {
    $r = Store::where('name', $name)->first();
    return $r ? true : false;
  }

  private function findStoreByName(string $name): Store
  {
    $r = Store::whereRaw('BINARY name = ?', $name)->first();
    throw_unless($r, StoreNotFoundException::class);
    return $r;
  }

  private function findStoreTrashedByName(string $name)
  {
    $r = Store::whereRaw('BINARY name = ?', $name)->withTrashed()->first();
    throw_unless($r, StoreNotFoundException::class);
    return $r;
  }

  public function get(): StoreCollectionInterface
  {
    return new StoreCollection(Store::latest()->get());
  }

  public function show(string $name): StoreResourceInterface
  {
    $store = $this->findStoreByName($name);
    return new StoreResource($store);
  }

  public function post(string $name): StoreResourceInterface
  {
    $exist = $this->checkIfStoreExist($name);
    \throw_unless(!$exist, StoreExistException::class);
    $store = Store::create([
      'name' => $name
    ]);
    return new StoreResource($store);
  }

  public function delete(string $name): StoreDeletedMessageInterface
  {
    $store = $this->findStoreTrashedByName($name);
    $store->forceDelete();
    return new StoreDeletedMessage();
  }

  public function restore(string $name): StoreResourceInterface
  {
    $store = $this->findStoreTrashedByName($name);
    \throw_unless($store->trashed(), StoreNotTrashedException::class);
    $store->restore();
    return new StoreResource($store);
  }

  public function update(string $name, StoreRequest $request): StoreResourceInterface
  {
    $store = $this->findStoreByName($name);
    $store->update($request->all());
    return new StoreResource($store);
  }

  public function trash(string $name): StoreTrashedMessageInterface
  {

    $store = $this->findStoreByName($name);
    $store->delete();
    return new StoreTrashedMessage();
  }
}
