<?php

namespace App\Exceptions;

use Exception;

abstract class ApplicationException extends Exception
{
    abstract public function status(): int;
    abstract public function error(): string|array;
    abstract public function help(): string;

    public function render()
    {
        return response()->json(["help" => $this->help(), "error" => $this->error()], $this->status());
    }
}
