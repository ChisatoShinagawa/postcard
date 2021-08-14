<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'orders' )->insert( [
        'id'          => '3333',
        'order_at'    => '2021-08-03 08:00:00',
        'delivery_at' => '2025-01-01 08:00:00',
        ]);
    }
}
