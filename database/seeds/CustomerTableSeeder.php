<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CustomerTableSeeder extends Seeder
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
        DB::table('customers')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $faker = Faker::create();
        for($i = 0; $i <= 100; $i++){
            DB::table('customers')->insert([
                'fname' => $faker->firstName,
                'lname' => $faker->firstName,
                'address' => $faker->text(),
                'age' => $faker->numberBetween(18,50),
                'phone' => $faker->phoneNumber,
                'mobile' => $faker->phoneNumber,
            ]);
        }

    }
}
