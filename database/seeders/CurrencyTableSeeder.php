<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;


class CurrencyTableSeeder extends Seeder {/**
     * Run the database seeds.
     *
     * @return void
     */

   public function run()
    {
        $currencyRecords =[
        	[
        	'id'=>1,
        	'currency_name'=>'US Dollar',
        	'currency_status'=>1,
        	'currency_symbol'=>'дол', 
        	'currency_iso'=>'USD',
        	'currency_rate'=>1],



       
        [
        	'id'=>2,
        	'currency_name'=>'Гривня',
        	'currency_status'=>1,
        	'currency_symbol'=>'грн', 
        	'currency_iso'=>'UAH',
        	'currency_rate'=>29.5],



        ];
        Currency::insert($currencyRecords);
    }
}
