<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Stancl\VirtualColumn\VirtualColumn;

class Wilaya extends Model
{
    use HasFactory;
    use VirtualColumn;

    public static function getCustomColumns(){
        return [
            'id','name','code','duration','infos','delivery_home','delivery_stopDesk',
        ];
    }
    
}
