<?php

namespace App\Http\Messages\Item;

use App\Http\Messages\ActionMessage;
use Illuminate\Http\Response;
use App\Interfaces\Items\ItemTrashedMessageInterface;

class ItemTrashedMessage extends ActionMessage implements ItemTrashedMessageInterface
{

  public function status(): int
  {
    return Response::HTTP_OK;
  }

  public function message(): string
  {
    return trans('messages.item_trashed');
  }
}
