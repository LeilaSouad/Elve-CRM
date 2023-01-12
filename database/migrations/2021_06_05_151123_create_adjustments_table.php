<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjustmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adjustments', function (Blueprint $table) {
        $table->id();
        $table->integer('warehouse_id');
        $table->decimal('subtotal');
        $table->decimal('total');
        $table->integer('currency_id');
        $table->decimal('currency_rate');
        $table->string('note');
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
        Schema::dropIfExists('adjustments');
    }
}
