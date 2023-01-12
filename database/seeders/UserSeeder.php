<?php

namespace Database\Seeders;
use App\Models\Role;
use App\Models\User;
use App\Models\Permissions;
use Illuminate\Database\Seeder;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $developer = Role::where('slug','developer')->first();
        $manager = Role::where('slug', 'manager')->first();
         $editor = Role::where('slug', 'editor')->first();
        $createTasks = Permissions::where('slug','create-tasks')->first();
        $manageUsers = Permissions::where('slug','manage-users')->first();
         $develope = Permissions::where('slug','developer')->first();
    
        
        $user4 = new User();
        $user4->name = 'Володимир Дрюков';
        $user4->email = 'mikey@thomas.com';
        $user4->password = bcrypt('secret');
        $user4->save();
        $user4->roles()->attach($developer);
        $user4->permissions()->attach($develope);
    }
}