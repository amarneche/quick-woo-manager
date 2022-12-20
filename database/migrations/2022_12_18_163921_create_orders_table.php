<?php

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string("name")->nullable();
            $table->string("phone")->nullable();
            $table->foreignId('wilaya_id');
            // $table->string("wilaya")->nullable();
            $table->string("commune")->nullable();
            $table->text("notes")->nullable();
            $table->string("status")->nullable();
            $table->integer("delivery_cost")->nullable();
            $table->string("delivery_type")->nullable();
            $table->json('data')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
