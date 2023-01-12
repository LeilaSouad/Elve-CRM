<?php

namespace Database\Seeders;
use App\Models\Permissions;
use Illuminate\Database\Seeder;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manageUser = new Permissions();
        $manageUser->name = 'Manage users';
        $manageUser->slug = 'manage-users';
        $manageUser->save();
        $createTasks = new Permissions();
        $createTasks->name = 'Create Tasks';
        $createTasks->slug = 'create-tasks';
        $createTasks->save();
           $developer = new Permissions();
        $develope->name = 'Developer';
        $develope->slug = 'developer';
        $develope->save();
    
    }
}