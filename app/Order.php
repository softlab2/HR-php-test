<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use stdClass;

class Order extends Model
{
    use Notifiable;

    const ORDER_STATUS_NEW = 0;
    const ORDER_STATUS_APPROVED = 10;
    const ORDER_STATUS_CLOSED = 20;

    protected $fillable = [
        'partner_id', 'status', 'client_email'
    ];

    public function products(){
        return $this->belongsToMany(\App\Product::class, 'order_products')->as('order_product')->withPivot('price', 'quantity');       
    }

    public function partner(){
        return $this->belongsTo(\App\Partner::class);
    }

    public function total() : int {
        $total = 0;
        foreach( $this->products as $product){
            $total += $product->order_product->price * $product->order_product->quantity;
        }
        return $total;
    }

    public function status() : array {
        $statuses = config('statuses.order', []);
        if(!empty($statuses[$this->status])) {
            return $statuses[$this->status];
        }else{
            return config('statuses.not_set');
        }
    }
}
