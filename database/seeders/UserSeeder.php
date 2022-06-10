<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            'id'=> 1,
            'name'=> 'admin',
            'email'=> 'admin@gmail.com',
            'phone'=> '081234567890',
            'address'=> 'Jakarta',
            'usertype' => '1',
            'password' => '12345678'
        ]);
        DB::table('user')->insert([
            'id'=> 1,
            'name'=> 'manajemen',
            'email'=> 'manajemen@gmail.com',
            'phone'=> '081234567891',
            'address'=> 'Jakarta',
            'usertype' => '2',
            'password' => '12345678'
        ]);
        DB::table('user')->insert([
            'id'=> 1,
            'name'=> 'apotek',
            'email'=> 'apotek@gmail.com',
            'phone'=> '081234567892',
            'address'=> 'Depok',
            'usertype' => '3',
            'password' => '12345678'
        ]);
    }
}
