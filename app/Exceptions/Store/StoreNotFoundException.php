<?php

namespace App\Exceptions\Store;

use App\Exceptions\ApplicationException;
use Illuminate\Http\Response;

class StoreNotFoundException extends ApplicationException
{


  public function status(): int
  {
    return Response::HTTP_NOT_FOUND;
  }
  public function help(): string
  {
    return trans('exception.store_not_found.help');
  }
  public function error(): string|array
  {
    return trans('exception.store_not_found.error');
  }
}
