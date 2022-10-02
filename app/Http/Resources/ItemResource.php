<?php

namespace App\Http\Resources;

use App\Interfaces\Items\ItemResourceInterface;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource implements ItemResourceInterface
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
            'price' => $this->price,
            'store_id' => $this->store->id
        ];
    }

    public static $wrap = null;
}
