<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class UserNotAuthorizedException extends ApplicationException
{

    public function status(): int
    {
        return Response::HTTP_UNAUTHORIZED;
    }
    public function help(): string
    {
        return trans('exception.user_not_authorized.help');
    }
    public function error(): string|array
    {
        return trans('exception.user_not_authorized.error');
    }
}
