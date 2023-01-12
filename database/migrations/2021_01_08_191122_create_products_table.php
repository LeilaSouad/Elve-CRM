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
            $table->integer('category_id');
            $table->integer('section_id');
            $table->string('product_name');
            $table->tinyInteger('status');
            $table->string('product_code');
            $table->float('sale_price');
            $table->float('wholesale_price');
            $table->float('purchase_price');
            $table->float('product_discount');
            $table->string('product_video');
            $table->string('product_main_image');
            $table->text('description');
            $table->string('url');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('product_form');
            $table->string('product_color');
            $table->string('product_type');
            $table->string('product_country');
            $table->string('product_fabric');
            $table->string('pile_height');
            $table->string('product_manufacturer');
            $table->string('product_pile_type');
            $table->string('product_pyle_density');
            $table->string('product_warp');
            $table->float('product_width');
            $table->float('product_length');
            $table->float('product_quantity');
            $table->string('product_unit');
            $table->float('product_height');
            $table->float('product_weight');
            $table->float('meters');
            $table->enum('is_featured',['No','Yes']);
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
}
