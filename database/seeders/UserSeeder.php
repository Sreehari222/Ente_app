<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@test.com',
                'password' => bcrypt('password'),
                'role' => 'admin'
            ],
            [
                'name' => 'Area Operator',
                'email' => 'area@test.com',
                'password' => bcrypt('password'),
                'role' => 'area_operator'
            ],
            [
                'name' => 'DEO',
                'email' => 'deo@test.com',
                'password' => bcrypt('password'),
                'role' => 'deo'
            ],
            [
                'name' => 'Salesman',
                'email' => 'sales@test.com',
                'password' => bcrypt('password'),
                'role' => 'salesman'
            ]
        ]);
    }
}
