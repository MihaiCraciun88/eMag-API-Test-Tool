<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->integer('mkt_id');
            $table->string('name');
            $table->string('company');
            $table->string('gender');
            $table->string('phone_1');
            $table->string('phone_2');
            $table->string('phone_3');
            $table->string('registration_number');
            $table->string('code');
            $table->string('email');
            $table->string('billing_name');
            $table->string('billing_phone');
            $table->string('billing_country');
            $table->string('billing_suburb');
            $table->string('billing_city');
            $table->string('billing_street');
            $table->string('billing_postal_code');
            $table->string('shipping_country');
            $table->string('shipping_suburb');
            $table->string('shipping_city');
            $table->string('shipping_postal_code');
            $table->string('shipping_contact');
            $table->string('shipping_phone');
            $table->string('shipping_street');
            $table->string('bank');
            $table->string('iban');
            $table->tinyInteger('is_vat_payer');
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
        Schema::dropIfExists('customers');
    }
}

/**
{
    "id": 4518188,
    "mkt_id": 4863439,
    "name": "Ruxandra Serbanescu",
    "company": "Ruxandra Serbanescu",
    "gender": "",
    "phone_1": "0724306676",
    "phone_2": "",
    "phone_3": "",
    "registration_number": "",
    "code": "",
    "email": "",
    "billing_name": "Ruxandra Serbanescu",
    "billing_phone": "0724306676",
    "billing_country": "RO",
    "billing_suburb": "Ilfov",
    "billing_city": "Corbeanca",
    "billing_locality_id": 41,
    "billing_street": "Strada Salcamului nr 8, Paradisul Verde , Corbeanca , ilfov",
    "billing_postal_code": "",
    "shipping_country": "RO",
    "shipping_suburb": "Ilfov",
    "shipping_city": "Corbeanca",
    "shipping_locality_id": 41,
    "shipping_postal_code": "",
    "shipping_contact": "Ruxandra Serbanescu",
    "shipping_phone": "0724306676",
    "created": "2021-12-03 16:09:36",
    "modified": "2021-12-03 16:09:36",
    "bank": "",
    "iban": "",
    "legal_entity": 0,
    "fax": null,
    "is_vat_payer": 1,
    "liable_person": "",
    "shipping_street": "Paradisul Verde, intrarea din Str. Scolii [EasyBox #9194]"
}
 */