<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesinvoicesProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
 public function up()
    {
        Schema::create('salesinvoices_products', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->unsignedBigInteger('salesinvoice_id');
            $table->unsignedBigInteger('product_id');
            $table->foreign('salesinvoice_id')->references('id')->on('salesinvoices')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->float('item_quantity');
            $table->float('item_discount');
            $table->float('item_price');
            $table->float('item_subtotal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('salesinvoices_products');
    }
}
