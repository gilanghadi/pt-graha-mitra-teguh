<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'password' => Hash::make('12345'),
            ],
            [
                'name' => 'User2',
                'email' => 'user2@user2.com',
                'password' => Hash::make('12345'),
            ]
        ];
        foreach ($data as $data) {
            User::create($data);
        }
    }
}
