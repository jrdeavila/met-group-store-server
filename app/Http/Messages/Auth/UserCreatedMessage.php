<?php

namespace App\Http\Messages\Auth;

use App\Http\Messages\ActionMessage;
use App\Interfaces\Auth\UserCreatedMessageInterface;
use Illuminate\Http\Response;

class UserCreatedMessage extends ActionMessage implements UserCreatedMessageInterface
{

  public function status(): int
  {
    return Response::HTTP_OK;
  }

  public function message(): string
  {
    return trans('messages.user_created');
  }
}
