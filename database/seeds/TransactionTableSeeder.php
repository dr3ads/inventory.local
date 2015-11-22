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
        for ($i = 1; $i <= 20; $i++) {
            $stat_random = rand(1, 3);
            $cust_random = rand(1, 100);

            $item_amount = $faker->randomFloat(2, 500, 20000);

            $item_id = DB::table('items')->insertGetId([
                'name' => $faker->text(50),
                'description' => $faker->paragraph(3),
                'value' => $item_amount,
            ]);

            DB::table('processes')->insert([
                'status' => $status[$stat_random],
                'ctrl_number' => getenv('BRANCH_ID') . $i,
                'customer_id' => $cust_random,
                'item_id' => $item_id,
                'pawn_amount' => $faker->randomFloat(2, 500, $item_amount),
                'expired_at' => \Carbon\Carbon::now()->addDays(14),
            ]);
        }
    }
}
