<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Receipts;

class ReceiptsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $receiptsRecords =[
        	[
        	'id'=>1,
        	'supplier_id'=>1,
        	'warehouse_id'=>1,
        	'currency_id'=>1,
        	'cashorder_id' => 1,
        	'receipt_quantity' =>2.00,
        	'receipt_tax' => 20,
        	'receipt_subtotal' =>32.00,
        	'receipt_total' =>32.00,
        	'receipt_discount' => 20,
        	'receipt_unit' =>'кв.м.',
        	'currency_rate' => 29.5,
        	'receipt_note' => 'ggggg',
        	'paid' => 32.00,
        	'paid_on' => '',
        	'created_on'=>'',
        	'created_by' =>1,
        	'modified_on' => '',
        	'modified_by' => 1,
        ]



        ]; 
        Receipts::insert($receiptsRecords);
    }
}
