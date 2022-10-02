<?php

namespace App\Http\Resources;

use App\Interfaces\Items\ItemCollectionInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ItemCollection extends ResourceCollection implements ItemCollectionInterface
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public static $wrap = "items";
}
