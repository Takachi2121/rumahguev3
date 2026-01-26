<?php

namespace Database\Seeders;

use App\Models\Mitra;
use App\Models\User;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(MaterialSeeder::class);
        $this->call(RecommendSeeder::class);
        // Mitra::factory(10)->create();
        User::create([
            'nama' => 'Admin Rumahgue',
            'email' => 'rumahgue@gmail.com',
            'password' => Hash::make('password'),
            'is_mitra' => 2
        ]);
    }
}
