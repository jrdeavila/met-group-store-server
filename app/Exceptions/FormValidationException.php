<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Validation\Validator;

class FormValidationException extends ApplicationException
{
    public Validator $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }



    public function status(): int
    {
        return Response::HTTP_UNPROCESSABLE_ENTITY;
    }
    public function help(): string
    {
        return trans('exception.form_validation.help');
    }
    public function error(): string| array
    {
        return (array)json_decode($this->validator->errors());
    }
}
