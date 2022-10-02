<?php

namespace App\Exceptions\Item;

use App\Exceptions\ApplicationException;
use Illuminate\Http\Response;

class ItemNotTrashedException extends ApplicationException
{
  public function status(): int
  {
    return Response::HTTP_BAD_REQUEST;
  }
  public function help(): string
  {
    return trans('exception.item_not_trashed.help');
  }
  public function error(): string|array
  {
    return trans('exception.item_not_trashed.error');
  }
}
