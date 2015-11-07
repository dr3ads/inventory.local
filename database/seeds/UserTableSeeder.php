<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('users')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $userId = DB::table('users')->insertGetId(
            ['email' => 'arnel.basiliote@gmail.com', 'password' => bcrypt('123qwerty')]
        );

        //add staff role
        $user = User::find($userId);
        $user->attachRole(1);
    }
}
