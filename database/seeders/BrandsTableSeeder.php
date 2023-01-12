<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brands;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brandsRecords = [
['id'=>1,'name'=>'Green Carpet','url'=>'green-carpet','description'=>'','image'=>'','meta_title'=>'','meta_description'=>'','status'=>1],
['id'=>2,'name'=>'Liza Carpet','url'=>'liza-carpet','description'=>'','image'=>'','meta_title'=>'','meta_description'=>'','status'=>1],
['id'=>10,'name'=>'Karat Carpet','url'=>'karat-carpet','description'=>'','image'=>'','meta_title'=>'','meta_description'=>'','status'=>1],
['id'=>12,'name'=>'Albayrak Carpet','url'=>'albayrak-carpet','description'=>'','image'=>'','meta_title'=>'','meta_description'=>'','status'=>1],
['id'=>9,'name'=>'Витебские ковры','url'=>'vitebsk-carpet','description'=>'','image'=>'','meta_title'=>'','meta_description'=>'','status'=>1],
['id'=>6,'name'=>'Konfetti Carpet','url'=>'konfetti-carpet','description'=>'','image'=>'','meta_title'=>'','meta_description'=>'','status'=>1]
        ];
        Brands::insert($brandsRecords);
    }
}
