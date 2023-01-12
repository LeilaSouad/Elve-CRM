<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('supplier_name');
            $table->string('supplier_address');
            $table->string('supplier_phone');
            $table->string('supplier_tax_number');
            $table->string('supplier_iban');
            $table->string('supplier_tax_bank');
            $table->string('supplier_tax_mfo');
            $table->string('supplier_email');
            $table->enum('supplier_nds',['No','Yes']);
            $table->string('supplier_discount_card');
            $table->string('supplier_price_type');
            $table->float('supplier_discount');
            $table->float('supplier_bonus');
            $table->string('supplier_additional_field');
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
        Schema::dropIfExists('suppliers');
    }
}
