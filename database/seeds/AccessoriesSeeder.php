<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AccessoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('accessories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker::create();

        for($i = 0; $i <= 100; $i++){
            DB::table('accessories')->insert([
                'name' => $faker->text(20),
                'description' => $faker->text(50),
                'quantity' => 100,
            ]);
        }
    }
}
