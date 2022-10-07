<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\AuthServiceMySql;

class LoginController extends Controller
{
    public function __invoke(AuthRequest $request, AuthServiceMySql $service)
    {
        return $service->login($request);
    }
}
