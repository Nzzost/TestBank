<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 30; $i++) {
            $createDat = rand(1420070400, 1507334400);
            DB::table('clients')->insert([
                'id'            => $i,
                'id_number'     => rand(1000000, 99999999),
                'first_name'    => str_random(10),
                'last_name'     => str_random(10),
                'gender'        => rand(0, 1),
                'birthday'      => date('Y-m-d H:i:s', rand(-285033600, 977270400)),
                'created_at'    => date('Y-m-d H:i:s', $createDat),
            ]);
            $num = rand(1,4);
            for ($y = 0; $y < $num; $y++) {
                DB::table('deposits')->insert([
                    'client_id'     => $i,
                    'money_balance' => rand(500, 20000),
                    'percent'       => rand(1, 4),
                    'created_at'    => date('Y-m-d H:i:s', rand($createDat, 1507334400)),
                ]);
            }
        }
    }
}
