<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('roles')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('roles')->insert([
            ['name' => 'staff', 'display_name' => 'Staff/Attendant', 'description' => 'Branch Staff user roles'],
            ['name' => 'branch_admin', 'display_name' => 'Branch Admin', 'description' => 'Branch Staff user roles'],
            ['name' => 'admin', 'display_name' => 'Super Admin', 'description' => 'Super Admin user roles'],
        ]);
    }
}
