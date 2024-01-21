<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            [
                'name' => "Admin 1",
                'email' => "admin@admin.com",
                'email_verified_at' => now(),
                'password' => Hash::make('admin'), // password
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Admin 2",
                'email' => "admin2@admin.com",
                'email_verified_at' => now(),
                'password' => Hash::make('admin'), //password
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Admin 3",
                'email' => "admin3@admin.com",
                'email_verified_at' => now(),
                'password' => Hash::make('123'), //password
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ]
        ];

        User::insert($admins);
    }
}
