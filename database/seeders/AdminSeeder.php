<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
                'password' => '$2a$10$9R8.auxr5qLdTvm59IcokOmEZ5y9HVJlsvEdaAKn22dWSsYbiQFZK', // password
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Admin 2",
                'email' => "admin2@admin.com",
                'email_verified_at' => now(),
                'password' => '$2a$10$9R8.auxr5qLdTvm59IcokOmEZ5y9HVJlsvEdaAKn22dWSsYbiQFZK', // password
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ],
            [
                'name' => "Admin 3",
                'email' => "admin3@admin.com",
                'email_verified_at' => now(),
                'password' => '$2a$10$awhGq0F1H80caSzTfxzYuOktnvxeo5IRBbDWyeEHYCuIh5niRUwJy', // password
                'role' => 'admin',
                'remember_token' => Str::random(10),
            ]
        ];

        User::insert($admins);
    }
}
