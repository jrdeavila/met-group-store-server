<?php

namespace App\Http\Messages;

use Illuminate\Http\Response;

class StoreTrashedMessage extends ActionMessage
{

  public function status(): int
  {
    return Response::HTTP_OK;
  }

  public function message(): string
  {
    return trans('messages.store_trashed');
  }
}
