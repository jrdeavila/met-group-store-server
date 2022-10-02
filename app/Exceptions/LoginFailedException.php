<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class LoginFailedException extends ApplicationException
{

    public function status(): int
    {
        return Response::HTTP_UNAUTHORIZED;
    }
    public function help(): string
    {
        return trans('auth.failed');
    }
    public function error(): string
    {
        return trans('auth.password');
    }
}
