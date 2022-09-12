<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('product_id');
            $table->string('name');
            $table->string('ext_part_number');
            $table->string('part_number_key');
            $table->string('currency', 3);
            $table->decimal('sale_price', 10, 2);
            $table->decimal('original_price', 10, 2);
            $table->decimal('vat', 10, 2);
            $table->integer('quantity');
            $table->tinyInteger('status');
            $table->dateTime('created');
            $table->dateTime('modified');
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
    }
}
