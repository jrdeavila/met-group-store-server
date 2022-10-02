<?php

namespace App\Http\Messages;

use App\Interfaces\Stores\StoreTrashedMessageInterface;
use Illuminate\Http\Response;

class StoreTrashedMessage extends ActionMessage implements StoreTrashedMessageInterface
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
