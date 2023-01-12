<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $adminRecords = [

['id'=>1,'name'=>'admin','type'=>'admin','mobile' =>'0932939305','email' =>'drukova.lila@gmail.com','password' =>'$2y$10$QndVwqMWtgrM3nRHc4vCv.D5Ib3Cjcj2irjxzxxHxuuUOjzGsa/hq','image'=>'','first_name'=>'Leila', 'last_name'=>'Driukova', 'post'=>'admin', 'status'=>1],

   ];
   foreach ($adminRecords as $key => $record) {

\App\Models\Admin::create($record);

   }
}

}
