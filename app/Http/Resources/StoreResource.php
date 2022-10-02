<?php

namespace App\Http\Resources;

use App\Interfaces\Stores\StoreResourceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class StoreResource extends JsonResource implements StoreResourceInterface
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
            'id' => $this->id,
            'name' => $this->name,
            'items' => new ItemCollection($this->items),
        ];
    }

    public static $wrap = null;
}
