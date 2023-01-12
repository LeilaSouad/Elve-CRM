<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $manager = new Role();
        $manager->name = 'Консультант';
        $manager->slug = 'manager';
        $manager->save();

        $developer = new Role();
        $developer->name = 'Developer';
        $developer->slug = 'developer';
        $developer->save();

        $editor = new Role();
        $editor->name = 'Редактор';
        $editor->slug = 'editor';
        $editor->save();
    }
}