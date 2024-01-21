<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            AdminSeeder::class,
            CartItemSeeder::class,
            OrderItemSeeder::class,
        ]);
        User::create([
            'name' => "Nay Ana",
            'email' => "test@test.com",
            'email_verified_at' => now(),
            'password' => Hash::make('123'), // password
            'role' => 'user',
            'remember_token' => Str::random(10),
        ]);
    }
}
