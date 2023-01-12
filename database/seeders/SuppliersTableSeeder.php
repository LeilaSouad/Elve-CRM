<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Suppliers;
class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $suppliersRecords =[
        	[
        	'id'=>1,
        	'supplier_name'=>'Green Carpet',
        	'supplier_address'=>'Хмельницький',
        	'supplier_phone'=>380000000000,
        	'supplier_tax_number'=>15151515,
        	'supplier_iban'=>141414141414,
        	'supplier_tax_bank'=>'ПриватБанк',
        	'supplier_tax_mfo'=>'15025',
        	'supplier_email'=>'greencarpet@gmail.com',
        	'supplier_nds'=>'No',
        	'supplier_discount_card'=>'12585888',
        	'supplier_price_type'=>'Purchase Price',
        	'supplier_discount'=>5,
        	'supplier_bonus'=>250,
        	'supplier_additional_field'=>'']



        ];
        Suppliers::insert($suppliersRecords);
    }
}
