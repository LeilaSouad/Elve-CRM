<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords =[
        	[
        	'id'=>1,
        	'category_id'=>3,
        	'section_id'=>1,
        	'product_name'=>'Mira 24001 бежевый 60х110', 
        	'product_code'=>'24001-1',
        	'purchase_price'=>10,
        	'sale_price'=>15,
        	'wholesale_price'=>14,
        	'product_discount'=>20,
        	'product_width'=>'',
        	'product_length'=>'',
        	'product_video'=>'',
        	'product_main_image'=>'',
        	'description'=>'',
        	'url'=>'',
        	'meta_title'=>'',
        	'meta_description'=>'',
        	'product_form'=>'Прямоугольный',
        	'product_color'=>'Beige',
        	'product_type'=>'Carpet',
        	'product_country'=>'Ukraine',
        	'product_fabric'=>'',
        	'pile_height'=>'6мм',
        	'product_manufacturer'=>'Carat Carpet',
        	'product_pile_type'=>'',
        	'product_pyle_density'=>'',
        	'product_warp'=>'',
        	'product_quantity'=>3,
        	'product_unit'=>'шт',
        	'is_featured'=>'Yes',
        	'status'=>1,
        	'product_weight'=>10]



        ];
        Product::insert($productRecords);
    }
}
