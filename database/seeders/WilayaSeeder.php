<?php

namespace Database\Seeders;

use App\Models\Wilaya;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WilayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        //read csv file  : delivery.csv;
        $json= file_get_contents(base_path().'/delivery.json');
        $wilayas=json_decode($json, true);
        Wilaya::insert($wilayas);
        
    }
}
