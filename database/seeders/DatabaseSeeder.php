<?php

namespace Database\Seeders;

use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(5)->create();
        $this->call([
            CartItemSeeder::class,
            OrderItemSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
