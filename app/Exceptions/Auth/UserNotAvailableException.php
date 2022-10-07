<?php

namespace App\Exceptions\Auth;

use App\Exceptions\ApplicationException;
use Illuminate\Http\Response;

class UserNotAvailableException extends ApplicationException
{

  public function status(): int
  {
    return Response::HTTP_UNAUTHORIZED;
  }
  public function help(): string
  {
    return trans('exception.user_not_available.help');
  }
  public function error(): string|array
  {
    return trans('exception.user_not_available.error');
  }
}
