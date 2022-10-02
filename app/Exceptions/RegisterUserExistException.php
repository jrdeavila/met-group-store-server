<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class RegisterUserExistException extends ApplicationException
{


    public function status(): int
    {
        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
    public function help(): string
    {
        return trans('exception.register_user_exist.help');
    }
    public function error(): string
    {
        return trans('exceptions.register_user_exist.error');
    }
}
