<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('part_number_key');
            $table->string('part_number');
            $table->string('currency', 3);
            $table->decimal('sale_price', 10, 2);
            $table->decimal('original_price', 10, 2);
            $table->decimal('vat', 10, 2);
            $table->tinyInteger('status');
            $table->integer('mkt_id');
            $table->integer('stock');
            $table->dateTime('created');
            $table->dateTime('modified');
            // $table->timestamps();

            $table->index(['mkt_id']);
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
}

/*
{
    "id": 87503654,
    "product_id": "4306074",
    "name": "Panglica decorativa cu lurex, fata dubla, bordo, latime 25 mm, lungime 5m",
    "ext_part_number": "4306074",
    "part_number_key": "DC3ZN7MBM",
    "part_number": "4306074",
    "retained_amount": 0,
    "sale_price": "10.0700",
    "original_price": "10.0700",
    "currency": "RON",
    "mkt_id": 65849550,
    "quantity": 1,
    "vat": "0.1900",
    "status": 1,
    "attachments": [],
    "initial_qty": 1,
    "storno_qty": 0,
    "reversible_vat_charging": 0,
    "product_voucher_split": [],
    "details": [],
    "created": "2021-12-03 16:09:36",
    "modified": "2021-12-07 05:47:11"
}
*/