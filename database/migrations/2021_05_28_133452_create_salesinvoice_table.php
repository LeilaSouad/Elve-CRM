<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesinvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salesinvoices', function (Blueprint $table) {
           $table->id();
        $table->integer('supplier_id');
        $table->integer('warehouse_id');
        $table->integer('currency_id');
        $table->decimal('salesinvoice_quantity');
        $table->decimal('salesinvoice_tax');
        $table->decimal('salesinvoice_subtotal');
        $table->decimal('salesinvoice_total');
        $table->decimal('salesinvoice_discount');
        $table->string('salesinvoice_unit');
        $table->decimal('currency_rate');
        $table->string('salesinvoice_note');
        $table->decimal('paid');
        $table->datetime('paid_on');
        $table->datetime('created_on');
        $table->integer('created_by');
        $table->datetime('modified_on');
        $table->integer('modified_by');
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
        Schema::dropIfExists('salesinvoices');
    }
}
