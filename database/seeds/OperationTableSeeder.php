<?php

use Illuminate\Database\Seeder;

class OperationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('operations')->insert([
            'name'    => 'Plus',
        ]);
        DB::table('operations')->insert([
            'name'    => 'Minus',
        ]);
    }
}
