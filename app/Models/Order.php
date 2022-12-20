<?php

namespace App\Models;
use Stancl\VirtualColumn\VirtualColumn;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use VirtualColumn;
    protected $guarded=[];
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'name',
            'phone',
            'wilaya_id',
            'commune',
            'order_notes',
            'order_status',
            'delivery_type',
            'delivery_cost',
        ];
    }

    public function items(){
        return $this->hasMany(OrderItem::class);
    }
    public function wilaya(){
        return $this->belongsTo(Wilaya::class);
    }

    public function getDeliveryMethodNameAttribute(){
        if($this->delivery=="home"){
            return "التوصيل الى المنزل";
        }
        if($this->delivery=="stopDesk"){
            return  "التوصيل الى المكتب";
        }
    }
    public function getDeliveryCostAttribute(){
        
        return $this->wilaya->{"delivery_$this->delivery"};
    }

    public function getTotalAttribute(){
         $subTotal=   $this->items->sum( function($item)  {
            return $item->price * $item->qte;
        } );
        return $this->delivery_cost + $subTotal;
    }
}
