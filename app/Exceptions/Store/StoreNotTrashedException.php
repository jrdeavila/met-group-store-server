<?php

namespace App\Exceptions\Store;

use App\Exceptions\ApplicationException;
use Illuminate\Http\Response;

class StoreNotTrashedException extends ApplicationException
{


  public function status(): int
  {
    return Response::HTTP_BAD_REQUEST;
  }
  public function help(): string
  {
    return trans('exception.store_not_trashed.help');
  }
  public function error(): string|array
  {
    return trans('exception.store_not_trashed.error');
  }
}
