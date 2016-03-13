<?php

use Illuminate\Database\Seeder;
use Lib\Processes\Process;
use Lib\Misc\Misc;
use Lib\Items\Item;
use Lib\Customers\Customer;
use Lib\Accessories\Accessory;
use Illuminate\Support\Facades\Log;

class RealDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('customers')->truncate();
        DB::table('items')->truncate();
        DB::table('processes')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $csv = array_map('str_getcsv', file(public_path() . '/data/inventory.csv'));

        $fields = array();
        $flag = 0;
        $data = array();
        foreach ($csv as $item) {
            if (empty($fields)) {
                $fields = $item;
                continue;
            }
            foreach ($item as $key => $value) {
                $data[$flag][$fields[$key]] = $value;
            }
            /*if ($flag == 10) {
                break;
            }*/

            $flag++;
        }
        foreach ($data as $row) {
            $name = explode(' ',$row['name']);
            $customer_data = array(
                'fname' => ucfirst($name[0]),
                'lname' => (isset($name[1])) ? ucfirst($name[1]) : '',
            );
            $customer = Customer::firstOrNew($customer_data);
            $customer->phone = $row['contact'];
            $customer->save();

            $item = new Item;
            $item->name = $row['brand'];
            $item->brand = $row['brand'];
            $item->serial = $row['serial'];
            $item->description = $row['accessories'];
            $item->save();

            $transaction = new Process;
            $transaction->ctrl_number = $row['ctrl_number'];
            $transaction->type = 'pawn';
            $transaction->customer_id = $customer->id;
            $transaction->item_id = $item->id;
            $transaction->pawn_amount = $row['principal'];
            $transaction->expired_at =  \Carbon\Carbon::parse()->addDays(14);
            $transaction->save();

        }
    }
}
