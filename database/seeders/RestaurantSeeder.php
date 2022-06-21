<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // สร้างข้อมูลเริ่มต้นลง DB
        DB::table( table: 'restaurants')->insert([
            'name' => 'Burger Big',
            'address' => '886 888 Wong Sawang Rd, Wong Sawang',
            'district' => 'Bang Sue',
            'province' => 'Bangkok',
            'state' => 'Bang sue',
            'open' => '09:00',
            'close' => '18:00',
            'img' => 'https://img.freepik.com/free-photo/restaurant-interior_1127-3394.jpg',
            'latitude' => 13.831682,
            'longitude' => 100.531344,
            'created_at' => date( format: 'Y-m-d H:i:s'),
            'updated_at' => date( format: 'Y-m-d H:i:s')

        ]);
        DB::table( table: 'restaurants')->insert([
            'name' => 'Steak Big',
            'address' => '162/1-2,168 10 Pracha Rat Sai 2 Rd',
            'district' => 'Bang Sue',
            'province' => 'Bangkok',
            'state' => 'Bang sue',
            'open' => '01:00',
            'close' => '06:00',
            'img' => 'https://img.freepik.com/free-photo/top-view-fresh-delicious-vietnamese-food-table_181624-50337.jpg',
            'latitude' => 13.828511,
            'longitude' => 100.522137,
            'created_at' => date( format: 'Y-m-d H:i:s'),
            'updated_at' => date( format: 'Y-m-d H:i:s')
        ]);

        DB::table( table: 'restaurants')->insert([
            'name' => 'chicken Big',
            'address' => '168 10 Pracha Rat Sai 5 Rd',
            'district' => 'Bang Sue',
            'province' => 'Bangkok',
            'state' => 'Bang sue',
            'open' => '08:00',
            'close' => '16:00',
            'img' => 'https://img.freepik.com/free-photo/white-teapot-chopsticks_1220-206.jpg',
            'latitude' => 13.833029,
            'longitude' => 100.528580,
            'created_at' => date( format: 'Y-m-d H:i:s'),
            'updated_at' => date( format: 'Y-m-d H:i:s')
        ]);

        DB::table( table: 'restaurants')->insert([
            'name' => 'Steak Boo',
            'address' => '1291 1 Phahonyothin Rd, Samsen Nai',
            'district' => 'Phaya Thai',
            'province' => 'Bangkok',
            'state' => 'Phaya thai',
            'open' => '10:00',
            'close' => '21:00',
            'img' => 'https://img.freepik.com/free-vector/fork-spoon-logo-vector-template_658089-1300.jpg',
            'latitude' => 13.778863,
            'longitude' => 100.536311,
            'created_at' => date( format: 'Y-m-d H:i:s'),
            'updated_at' => date( format: 'Y-m-d H:i:s')
        ]);
    }
}
