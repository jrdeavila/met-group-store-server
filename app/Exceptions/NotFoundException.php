<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class NotFoundException extends ApplicationException
{

  public function status(): int
  {
    return Response::HTTP_NOT_FOUND;
  }

  public function error(): string
  {
    return "Not found this resource";
  }

  public function help(): string
  {
    return "Please, check the resource requested";
  }
}
