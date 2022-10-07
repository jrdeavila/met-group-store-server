<?php

namespace App\Http\Resources;

use App\Interfaces\Auth\LoginResourceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class LoginResource extends JsonResource implements LoginResourceInterface
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'access_token' => $this->createToken('My Personal Token')->accessToken
        ];
    }

    public static $wrap = null;
}
