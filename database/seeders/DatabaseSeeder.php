<?php

namespace Database\Seeders;

use App\Models\TypeOfServices as ModelsTypeOfServices;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\TypeOfServices;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(UsersSeeder::class);
        $this->call(LevelsSeeder::class);
        $this->call(TypeOfServicesSeeder::class);



        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
