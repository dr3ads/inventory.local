<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        Eloquent::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('items')->truncate();
        DB::table('processes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $status = [
            1 => 'active',
            2 => 'claimed',
            3 => 'expired',
        ];
        for ($i = 1; $i <= 100; $i++) {
            $stat_random = rand(1, 3);
            $cust_random = rand(1, 100);

            $pawn_date = \Carbon\Carbon::instance($faker->dateTimeThisMonth());

            $item_amount = $faker->randomFloat(2, 500, 20000);

            $item_id = DB::table('items')->insertGetId([
                'name' => $faker->text(50),
                'brand' => $faker->text(20),
                'serial' => $faker->text(10),
                'description' => $faker->paragraph(3),
                'value' => $item_amount,
            ]);

            DB::table('processes')->insert([
                'status' => 'active',
                'ctrl_number' => getenv('BRANCH_ID') . $i,
                'customer_id' => $cust_random,
                'item_id' => $item_id,
                'pawn_amount' => $faker->randomFloat(2, 500, $item_amount),
                'pawned_at' => $pawn_date,
                'expired_at' => \Carbon\Carbon::parse($pawn_date)->addDays(14),
            ]);
        }
    }
}
