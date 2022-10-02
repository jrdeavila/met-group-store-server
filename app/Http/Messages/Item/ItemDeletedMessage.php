<?php

namespace App\Http\Messages\Item;

use App\Http\Messages\ActionMessage;
use App\Interfaces\Items\ItemDeletedMessageInterface;
use Illuminate\Http\Response;

class ItemDeletedMessage extends ActionMessage implements ItemDeletedMessageInterface
{

  public function message(): string
  {
    return trans("messages.item_deleted");
  }

  public function status(): int
  {
    return Response::HTTP_OK;
  }
}
