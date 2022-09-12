<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
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
            $table->tinyInteger('type');
            $table->integer('mkt_id');
            $table->string('vendor_name', 100);
            $table->integer('parent_id');
            $table->dateTime('date');
            $table->dateTime('finalization_date');
            $table->dateTime('maximum_date_for_shipment');
            $table->string('payment_mode', 20);
            $table->string('detailed_payment_method', 20);
            $table->tinyInteger('payment_mode_id');
            $table->string('delivery_mode', 20);
            $table->string('observation');
            $table->tinyInteger('status');
            $table->tinyInteger('payment_status');
            $table->integer('customer_id');
            $table->decimal('shipping_tax');
            $table->tinyInteger('has_editable_products');
            $table->decimal('refunded_amount');
            $table->tinyInteger('is_complete');
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
        Schema::dropIfExists('orders');
    }
}

/*
{
    "id": 239110929,
    "vendor_name": "Delideco Cake",
    "type": 3,
    "parent_id": null,
    "date": "2021-12-05 11:19:26",
    "payment_mode": "RAMBURS",
    "detailed_payment_method": "RAMBURS",
    "payment_mode_id": 1,
    "delivery_mode": "pickup",
    "observation": null,
    "status": 4,
    "payment_status": 0,
    "customer": {},
    "products": [],
    "shipping_tax": 14.99,
    "shipping_tax_voucher_split": [],
    "vouchers": [],
    "proforms": [],
    "attachments": [],
    "cashed_co": null,
    "cashed_cod": 0,
    "cancellation_request": null,
    "has_editable_products": 1,
    "refunded_amount": "0",
    "is_complete": 1,
    "refund_status": null,
    "maximum_date_for_shipment": "2021-12-07 11:19:27",
    "late_shipment": 0,
    "emag_club": 0,
    "finalization_date": "2021-12-07 10:58:53",
    "details": {},
    "weekend_delivery": 0
}
*/