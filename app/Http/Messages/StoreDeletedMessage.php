<?php

namespace App\Http\Messages;

use App\Interfaces\Stores\StoreDeletedMessageInterface;
use Illuminate\Http\Response;

class StoreDeletedMessage extends ActionMessage implements StoreDeletedMessageInterface
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
