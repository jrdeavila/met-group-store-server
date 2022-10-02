<?php

namespace App\Exceptions\Item;

use App\Exceptions\ApplicationException;
use Illuminate\Http\Response;

class ItemExistException extends ApplicationException
{


  public function status(): int
  {
    return Response::HTTP_UNPROCESSABLE_ENTITY;
  }
  public function help(): string
  {
    return trans('exception.item_exist.help');
  }
  public function error(): string|array
  {
    return trans('exception.item_exist.error');
  }
}
