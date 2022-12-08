<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create([
            'name' => 'Muhammad Mardiansyah',
            'slug' => 'mardi',
            'email' => 'mardi@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'new' => 1,
            'date_of_birth' => now(),
            'stay_in' => "Indonesia",
            'gender' => 'male',
            'relationship' => 'Jomblo',
            'bio' => 'hai'
        ]);
        \App\Models\User::factory(50)->create();
        Post::factory(100)->create();
    }
}
