<?php

namespace App\Http\Messages;

use Illuminate\Http\Response;

class StoreDeletedMessage extends ActionMessage
{

  public function message(): string
  {
    return trans("messages.store_deleted");
  }

  public function status(): int
  {
    return Response::HTTP_OK;
  }
}
