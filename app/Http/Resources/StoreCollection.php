<?php

namespace App\Http\Resources;

use App\Interfaces\Stores\StoreCollectionInterface;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StoreCollection extends ResourceCollection implements StoreCollectionInterface
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


    public static $wrap = "stores";
}
