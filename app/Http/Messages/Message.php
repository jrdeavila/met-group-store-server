<?php

namespace App\Http\Messages;


class Message
{
  public string $message;
  public int $code;

  public function __construct(string $message, int $code)
  {
    $this->message = $message;
    $this->code = $code;
  }
}
