<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\VirtualColumn\VirtualColumn;

class OrderItem extends Model
{
    use HasFactory;
    use VirtualColumn;
    protected $guarded=[];
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'product_id',
            'product_title',
            'order_id',
            'qte',
            'price',
        ];
        
    }
    public function order(){
        return $this->belongsTo(Order::class);

    }
    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function getProductThumbnailUrlAttribute(){
        if(!is_null($this->product)){
            return $this->product->getFirstMediaUrl('featured','thumbnail');
        }
    }
    public function getSubTotalAttribute(){
        return $this->price*$this->qte;
    }
}
