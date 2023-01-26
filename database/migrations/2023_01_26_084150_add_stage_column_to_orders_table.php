<?php

use App\Models\Order;
use App\Models\OrderStage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {

            $table->foreignId('order_stage_id')->nullable();

        });
        $defaultStage = OrderStage::first();
        Order::whereIn('id',Order::all()->pluck('id'))->update(['order_stage_id'=>$defaultStage->id]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
            $table->dropForeignIdFor(OrderStage::class);
            $table->dropColumn('order_stage_id');
        });
    }
};
