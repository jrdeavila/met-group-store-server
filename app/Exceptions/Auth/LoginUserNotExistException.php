<?php

namespace App\Exceptions\Auth;

use App\Exceptions\ApplicationException;
use Illuminate\Http\Response;



class LoginUserNotExistException extends ApplicationException
{


    public function status(): int
    {
        return Response::HTTP_NOT_FOUND;
    }
    public function help(): string
    {
        return trans('exception.login_user_not_exist.help');
    }
    public function error(): string
    {
        return trans('exception.login_user_not_exist.error');
    }
}
