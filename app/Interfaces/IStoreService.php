<?php

namespace App\Interfaces;

use App\Http\Messages\StoreDeletedMessage;
use App\Http\Messages\StoreTrashedMessage;
use App\Http\Requests\StoreRequest;
use App\Http\Resources\StoreCollection;
use App\Http\Resources\StoreResource;

interface IStoreService
{
  public function get(): StoreCollection;
  public function show(string $name): StoreResource;
  public function post(string $name): StoreResource;
  public function delete(string $name): StoreDeletedMessage;
  public function restore(string $name): StoreResource;
  public function update(string $name, StoreRequest $request): StoreResource;
  public function trash(string $name): StoreTrashedMessage;
}
