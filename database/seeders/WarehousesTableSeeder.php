<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Warehouse;
class WarehousesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
   public function run()
    {
        $warehousesRecords =[
        	[
        	'id'=>1,
        	'warehouse_name'=>'Складн №1',
        	'warehouse_address'=>'Хмельницький, вул. Геологів 8',
        	'status'=>1]



        ];
        Warehouse::insert($warehousesRecords);
    }
}
