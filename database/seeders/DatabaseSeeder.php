<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Joel Cerezo',
            'email' => 'joel.cerezo@example.com',
            'password' => bcrypt("12345678")
        ]);

        Product::factory(3000)->create();
    }
}
