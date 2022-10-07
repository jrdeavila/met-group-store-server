<?php


namespace App\Exceptions\Auth;

use App\Exceptions\ApplicationException;
use Illuminate\Http\Response as HttpResponse;

class RegisterUserExistException extends ApplicationException
{


    public function status(): int
    {
        return HttpResponse::HTTP_BAD_REQUEST;
    }
    public function help(): string
    {
        return trans('exception.register_user_exist.help');
    }
    public function error(): string
    {
        return trans('exception.register_user_exist.error');
    }
}
