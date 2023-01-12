<?php

namespace Database\Seeders;
use App\Section;

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionsRecords = [
['id'=>1,'name'=>'Ковры','status'=>1],
['id'=>2,'name'=>'Дорожки','status'=>1],

        ];
        \App\Models\Section::insert($sectionsRecords);
    }
}
