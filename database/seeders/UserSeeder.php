<?php

namespace Database\Seeders;

use App\Models\User;
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
            'name' => 'Sam',
            'email' => 'sam@test.com',
            'is_admin' => true,
            'password' => Hash::make('password'),
            ],
            [
                'name' => 'Ram',
            'email' => 'ram@test.com',
            'is_admin' => false,
            'password' => Hash::make('password'),
            ]
            ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
