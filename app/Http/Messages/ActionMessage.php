<?php

namespace App\Http\Messages;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class ActionMessage extends JsonResource
{


  public function __construct()
  {
  }

  public abstract function message(): string;

  public abstract function status(): int;

  public function toArray($request)
  {
    return [
      'message' => $this->message(),
    ];
  }

  public function toResponse($request)
  {
    return response()->json($this->toArray($request), $this->status());
  }
}
