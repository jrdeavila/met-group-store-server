<?php

namespace App\Exceptions\Item;

use App\Exceptions\ApplicationException;
use Illuminate\Http\Response;

class ItemNotFoundException extends ApplicationException
{


  public function status(): int
  {
    return Response::HTTP_NOT_FOUND;
  }
  public function help(): string
  {
    return trans('exception.item_not_found.help');
  }
  public function error(): string|array
  {
    return trans('exception.item_not_found.error');
  }
}
