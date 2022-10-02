<?php

namespace App\Exceptions\Store;

use App\Exceptions\ApplicationException;
use Illuminate\Http\Response;

class StoreExistException extends ApplicationException
{


  public function status(): int
  {
    return Response::HTTP_UNPROCESSABLE_ENTITY;
  }
  public function help(): string
  {
    return trans('exception.store_exist.help');
  }
  public function error(): string|array
  {
    return trans('exception.store_exist.error');
  }
}
