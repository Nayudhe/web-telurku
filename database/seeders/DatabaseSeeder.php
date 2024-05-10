<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\Product;
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
        Product::create([
            'name' => "Telur Ayam Negeri",
            'price' => 100000,
            'description' => "Telur ayam negeri dengan kualitas terbaik",
            'stock' => 200,
            'image' => 'default.jpg',
        ]);
        Product::create([
            'name' => "Telur Omega",
            'price' => 180000,
            'description' => "Telur omega dengan kualitas terbaik",
            'stock' => 187,
            'image' => 'default.jpg',
        ]);
        Product::create([
            'name' => "Telur Ayam Kampung",
            'price' => 140000,
            'description' => "Telur ayam kampung dengan kualitas terbaik",
            'stock' => 178,
            'image' => 'default.jpg',
        ]);
        Product::create([
            'name' => "Telur Ayam Bebas",
            'price' => 70000,
            'description' => "Telur ayam bebas dengan kualitas terbaik",
            'stock' => 135,
            'image' => 'default.jpg',
        ]);

        $this->call([
            AdminSeeder::class,
            CartItemSeeder::class,
            OrderItemSeeder::class,
        ]);
        Message::factory(10)->create();
        User::create([
            'name' => "Nay Anako",
            'email' => "test@test.com",
            'email_verified_at' => now(),
            'password' => Hash::make('123'), // password
            'role' => 'user',
            'remember_token' => Str::random(10),
        ]);
    }
}
