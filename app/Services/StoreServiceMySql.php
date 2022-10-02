<?php

namespace App\Services;

use App\Exceptions\Store\StoreExistException;
use App\Exceptions\Store\StoreNotFoundException;
use App\Http\Messages\StoreDeletedMessage;
use App\Http\Messages\StoreTrashedMessage;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\StoreCollection;
use App\Http\Resources\StoreResource;
use App\Interfaces\IStoreService;
use App\Models\Store;

class StoreServiceMySql implements IStoreService
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

  public function get(): StoreCollection
  {
    return new StoreCollection(Store::latest()->get());
  }

  public function show(string $name): StoreResource
  {
    $store = $this->findStoreByName($name);
    return new StoreResource($store);
  }

  public function post(string $name): StoreResource
  {
    $exist = $this->checkIfStoreExist($name);
    \throw_unless(!$exist, StoreExistException::class);
    $store = Store::create([
      'name' => $name
    ]);
    return new StoreResource($store);
  }

  public function delete(string $name): StoreDeletedMessage
  {
    $store = $this->findStoreTrashedByName($name);
    $store->forceDelete();
    return new StoreDeletedMessage();
  }

  public function restore(string $name): StoreResource
  {
    $store = $this->findStoreTrashedByName($name);
    $store->restore();
    return new StoreResource($store);
  }

  public function update(string $name, StoreRequest $request): StoreResource
  {
    $store = $this->findStoreByName($name);
    $store->update($request->all());
    return new StoreResource($store);
  }

  public function trash(string $name): StoreTrashedMessage
  {

    $store = $this->findStoreByName($name);
    $store->delete();
    return new StoreTrashedMessage();
  }
}
