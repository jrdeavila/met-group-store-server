<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;

class ExpectedJsonException extends ApplicationException
{


    public function status(): int
    {
        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }
    public function help(): string
    {
        return trans('exception.expected_json.help');
    }
    public function error(): string
    {
        return trans('exception.expected_json.error');
    }
}
