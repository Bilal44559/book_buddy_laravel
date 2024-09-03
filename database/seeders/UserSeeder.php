<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin786'),
                'user_type' => 'admin'
            ],
            [
                'name' => 'Ahtisham',
                'email' => 'ahtisham@gmail.com',
                'password' => Hash::make('admin786'),
                'user_type' => 'user'
            ]
        ];

        \App\Models\User::insert($users);
    }
}
