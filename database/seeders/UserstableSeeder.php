<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserstableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $imagePath = 'https://i.ibb.co/1sspJdY/Akik-Hossain.jpg';

            User::create([
                'name' => 'Shadrack Onyango',
                'role' => 'employee',
                'email' => 'shadrackonyango30@gmail.com',
                'password' => bcrypt('shaddy123'),
                'image' => $imagePath,
            ]);

            User::create([
                'name' => 'Cynthia Shisia',
                'role' => 'admin',
                'email' => 'cynthiaajwang6@gmail.com',
                'password' => bcrypt('cynthia456'),
                'image' => $imagePath,
            ]);

            User::create([
                'name' => 'Gonzaga Shyachi',
                'role' => 'employee',
                'email' => 'gonzagagene@gmail.com',
                'password' => bcrypt('gene789'),
                'image' => $imagePath,
            ]);

    }
}
