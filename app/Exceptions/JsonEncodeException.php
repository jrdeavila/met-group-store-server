<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class JsonEncodeException extends ApplicationException
{
    public function status(): int
    {
        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
    public function help(): string
    {
        return trans('exception.json_not_encoded.help');
    }
    public function error(): string
    {
        return trans('exceptions.json_not_encoded.error');
    }
}
