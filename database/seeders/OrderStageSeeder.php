<?php

namespace Database\Seeders;

use App\Models\OrderStage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        OrderStage::firstOrCreate(['name'=>'processing','color'=>'transparent']);
        OrderStage::firstOrCreate(['name'=>'canceled','color'=>'transparent']);
        OrderStage::firstOrCreate(['name'=>'confirmation','color'=>'transparent']);
        OrderStage::firstOrCreate(['name'=>'confirmed','color'=>'transparent']);
        OrderStage::firstOrCreate(['name'=>'preparation','color'=>'transparent']);
        OrderStage::firstOrCreate(['name'=>'in-delivery','color'=>'transparent']);
        OrderStage::firstOrCreate(['name'=>'delivered','color'=>'transparent']);
        OrderStage::firstOrCreate(['name'=>'return','color'=>'transparent']);
        OrderStage::firstOrCreate(['name'=>'complete','color'=>'green']);
    }
}
