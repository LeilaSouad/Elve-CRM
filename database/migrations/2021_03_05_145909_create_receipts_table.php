<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
        $table->id();
        $table->integer('supplier_id');
        $table->integer('warehouse_id');
        $table->integer('currency_id');
        $table->integer('cashorder_id');
        $table->decimal('receipt_quantity');
        $table->decimal('receipt_tax');
        $table->decimal('receipt_subtotal');
        $table->decimal('receipt_total');
        $table->decimal('receipt_discount');
        $table->string('receipt_unit');
        $table->decimal('currency_rate');
        $table->string('receipt_note');
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
        Schema::dropIfExists('receipts');
    }
}
