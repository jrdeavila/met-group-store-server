<?php

namespace App\Exceptions\Auth;

use App\Exceptions\ApplicationException;
use Illuminate\Http\Response;


class LoginFailedException extends ApplicationException
{

    public function status(): int
    {
        return Response::HTTP_UNAUTHORIZED;
    }
    public function help(): string
    {
        return trans('exception.login_failed.help');
    }
    public function error(): string
    {
        return trans('exception.login_failed.error');
    }
}
