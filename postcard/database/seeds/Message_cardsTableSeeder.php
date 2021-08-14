<?php

use Illuminate\Database\Seeder;

class Message_cardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table( 'message_cards' )->insert( [
        'order_id' => '12',
        ]);

        DB::table( 'message_cards' )->insert( [
        'order_id' => '1',
        ]);

        DB::table( 'message_cards' )->insert( [
        'order_id' => '2',
        ]);

        DB::table( 'message_cards' )->insert( [
        'order_id' => '3',
        ]);

        DB::table( 'message_cards' )->insert( [
        'order_id' => '5',
        ]);

        DB::table( 'message_cards' )->insert( [
        'order_id' => '6',
        ]);

        DB::table( 'message_cards' )->insert( [
        'order_id' => '7',
        ]);

        DB::table( 'message_cards' )->insert( [
        'order_id' => '8',
        ]);

        DB::table( 'message_cards' )->insert( [
        'order_id' => '9',
        ]);

        DB::table( 'message_cards' )->insert( [
        'order_id' => '10',
        ]);

        DB::table( 'message_cards' )->insert( [
        'order_id' => '11',
        ]);
    }
}
