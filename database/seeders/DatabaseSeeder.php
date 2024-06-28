<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB:table('catagories')->insert([
            ['name' => 'NHẪN BẠC', 'slug'=>'nhan-bac'], 
            ['name' => 'BÔNG TAI BẠC', 'slug'=>'bong-tai-bac'],
            ['name' => 'LẮC TAY BẠC', 'slug'=>'lac-tay-bac'],
            ['name' => 'DÂY CHUYỀN BẠC', 'slug'=>'day-chuyen-bac'],
            ['name' => 'PHỤ KIỆN', 'slug'=>'phu-kien']
        ]);
    }
}
