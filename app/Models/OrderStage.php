<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\VirtualColumn\VirtualColumn;

class OrderStage extends Model
{
    use HasFactory;
    use VirtualColumn;
    protected $guarded =[];

    public static function getCustomColumns() : array {
        return ['id','name','color','description', 'created_at','updated_at'];
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

}
