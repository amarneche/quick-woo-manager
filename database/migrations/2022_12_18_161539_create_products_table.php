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
        Schema::create('products', function (Blueprint $table) {
            //required by Facebook.
            $table->id();
            $table->string('sku')->unique()->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text("description")->nullable();
            $table->string('availability')->default("in stock");
            $table->string('condition')->default("new");
            $table->string('brand')->default("White Label");
            $table->integer('price');

            $table->text("short_description")->nullable();
            $table->text("product_description")->nullable();
            $table->integer('sale_price')->nullable();
            $table->datetime('sale_price_effective_starts')->nullable();
            $table->datetime('sale_price_effective_ends')->nullable();
            $table->string('gender')->default("unisex");
            $table->string("age_group")->default("adult");
            $table->string("shipping_weight")->nullable();
            $table->string("material")->nullable();
            $table->string('color')->nullable();
            $table->string('size')->nullable();

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
        Schema::dropIfExists('products');
    }
};
