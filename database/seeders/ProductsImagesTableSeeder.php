<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductsImage;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productsImagesRecords = [
        	['id' =>1,'product_id'=>7,'image'=>'042-22-6.jpg-982419859.jpg','image_alt'=>'Ковер 	Tempo 7382A Beige 120х180', 'image_title'=>'Tempo 7382A Beige 120х180','status'=>1]
        ];
        ProductsImage::insert($productsImagesRecords);
    }
}
