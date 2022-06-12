<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Medicine;

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
        User::create([
            'id' => '100',
            'name' => 'test',
            'email'=>  'test@example.com',
            'phone'=> '08123456789',
            'address'=> 'Depok',
            'usertype'=> '0',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'admin',
            'email'=>  'admin@example.com',
            'phone'=> '081234567890',
            'address'=> 'Jakarta',
            'usertype'=> '1',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'manajemen',
            'email'=>  'manajemen@example.com',
            'phone'=> '081234567891',
            'address'=> 'Jakarta',
            'usertype'=> '2',
            'phone'=> '081234567891',
            'password' => Hash::make('12345678'),
        ]);
        User::create([
            'name' => 'apoteker',
            'email'=>  'apoteker@example.com',
            'phone'=> '081234567892',
            'address'=> 'Depok',
            'usertype'=> '3',
            'password' => Hash::make('12345678'),
        ]);

        Appointment::create([
            'name' => 'test',
            'email'=>  'test@example.com',
            'phone'=> '08123456789',
            'doctor'=> 'Doctor test',
            'date'=> '2022-1-1',
            'message'=> 'Sakit Kepala',
            'status'=> 'In Progress',
            'user_id'=> '100',
        ]);

        Doctor::create([
            'name' => 'Doctor test',
            'phone'=> '0123456789',
            'speciality'=> 'General Health',
            'room'=> '001',
            'image' => 'example.jpg'
        ]);

        Medicine::create([
            'name' => 'Bodrex',
            'stock'=> 1000,
            'description'=> 'Obat sakit kepala',
            'created_at'=> '2022-08-17',
            'expired'=> '2030-08-17',
        ]);
    }
}
