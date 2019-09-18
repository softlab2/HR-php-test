<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;
use App\Http\Resources\Partner as PartnerResource;
use App\Http\Resources\Product as ProductResource;

class Order extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $res = parent::toArray($request);
        $res['partner'] = $this->partner;
        $res['total'] = $this->total();
        $res['status'] = $this->status();
        $res['products'] = $this->products;
        return $res;
    }
}
