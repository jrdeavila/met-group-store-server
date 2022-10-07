<?php

namespace App\Services;

use App\Exceptions\Auth\LoginFailedException;
use App\Exceptions\Auth\LoginUserNotExistException;
use App\Exceptions\Auth\RegisterUserExistException;
use App\Exceptions\Auth\UserNotAvailableException;
use App\Http\Messages\Auth\UserCreatedMessage;
use App\Http\Requests\AuthRequest;
use App\Http\Resources\LoginResource;
use App\Interfaces\Auth\AuthServiceInterface;
use App\Interfaces\Auth\LoginResourceInterface;
use App\Interfaces\Auth\UserCreatedMessageInterface;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthServiceMySql implements AuthServiceInterface
{
  private function findUserByUsername(string $username): User
  {
    $user = User::withTrashed()->where('username', $username)->first();
    \throw_unless($user, LoginUserNotExistException::class);
    return $user;
  }

  private function checkIfUserExist(string $username)
  {
    try {
      $this->findUserByUsername($username);
      return true;
    } catch (LoginUserNotExistException) {
      return false;
    }
  }
  public function login(AuthRequest $request): LoginResourceInterface
  {
    $crendentials = $request->only('username', 'password');
    $user = $this->findUserByUsername($crendentials['username']);
    throw_unless(!$user->trashed(), UserNotAvailableException::class);
    if (!Auth::guard('web')->attempt($crendentials)) throw new LoginFailedException();
    return new LoginResource(Auth::guard('web')->user());
  }



  public function register(AuthRequest $request): UserCreatedMessageInterface
  {
    $crendentials = $request->only('username', 'password');
    $exist = $this->checkIfUserExist($crendentials['username']);
    \throw_unless(!$exist, RegisterUserExistException::class);
    User::create([
      'username' => $crendentials['username'],
      'password' => Hash::make($crendentials['password']),
    ]);
    return new UserCreatedMessage();
  }
}
