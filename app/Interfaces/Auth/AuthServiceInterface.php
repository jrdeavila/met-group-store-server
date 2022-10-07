<?php

namespace App\Interfaces\Auth;

use App\Http\Requests\AuthRequest;

interface AuthServiceInterface
{
  public function login(AuthRequest $request): LoginResourceInterface;
  public function register(AuthRequest $request): UserCreatedMessageInterface;
}
