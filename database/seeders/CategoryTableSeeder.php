<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryRecords = [

['id'=>1,'parent_id'=>0,'section_id'=>0,'name'=>'Ковры','category_image'=>'','image_alt'=>'','category_discount'=>0, 'description'=>'','url'=>'kovry','meta_title'=>'','meta_description'=>'','status'=>1],
['id'=>2,'parent_id'=>0,'section_id'=>1,'name'=>'Ковровые дорожки','category_image'=>'','image_alt'=>'','category_discount'=>0,'description'=>'','url'=>'kovrovye-dorojky','meta_title'=>'','meta_description'=>'','status'=>1],
['id'=>3,'parent_id'=>0,'section_id'=>0,'name'=>'Паласы','category_image'=>'','image_alt'=>'','category_discount'=>0,'image'=>'', 'description'=>'','url'=>'palasy','meta_title'=>'','meta_description'=>'','status'=>1],
['id'=>4,'parent_id'=>0,'section_id'=>0,'name'=>'Циновки','category_image'=>'','image_alt'=>'','category_discount'=>0, 'description'=>'','url'=>'tsinovki','meta_title'=>'','meta_description'=>'','status'=>1],
['id'=>5,'parent_id'=>0,'section_id'=>0,'name'=>'Коврики в ванную','category_image'=>'','image_alt'=>'','category_discount'=>0, 'category_image'=>'','description'=>'','url'=>'kovry-v-vannuyu','meta_title'=>'','meta_description'=>'','status'=>1],

        ];
        Category::insert($categoryRecords);
    }
}
