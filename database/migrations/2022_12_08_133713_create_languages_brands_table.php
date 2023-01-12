<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages_brands', function (Blueprint $table) {
          
            
            $table->bigIncrements('id'); 
            
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
           
            $table->string('brand_name');
            $table->string('brand_description');
            $table->string('meta_description');
            $table->string('meta_title');
            $table->string('brand_url');
            
            
            
            
            
            
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages_brands');
    }
}
