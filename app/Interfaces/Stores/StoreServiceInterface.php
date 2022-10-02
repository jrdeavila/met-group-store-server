<?php

namespace App\Interfaces\Stores;

use App\Http\Requests\StoreRequest;

interface StoreServiceInterface
{
  public function get(): StoreCollectionInterface;
  public function show(string $name): StoreResourceInterface;
  public function post(string $name): StoreResourceInterface;
  public function delete(string $name): StoreDeletedMessageInterface;
  public function restore(string $name): StoreResourceInterface;
  public function update(string $name, StoreRequest $request): StoreResourceInterface;
  public function trash(string $name): StoreTrashedMessageInterface;
}
