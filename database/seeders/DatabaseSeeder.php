<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Schedule;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()
            ->state(new Sequence(
                [
                    'name' => 'admin',
                    'email' => 'admin@gmail.com',
                    'nim_or_nik' => '1201202020',
                    'is_admin' => '1'
                ]
            ))->create();

        User::factory(10)->create();

        // User::factory()->create([
        //     'nim_or_nik' => '1201202020',
        //     'password' => 'password',
        //     'email' => 'test@mail.com',
        //     'name' => 'test',
        //     'profile_picture' => 'https://i.pravatar.cc/300',
        //     'address_id' => 
        // ]);

        // User::factory()->create([
        //     'nim_or_nik' => '1234567890',
        //     'password' => '12345678',
        //     'email' => 'test@mail.com',
        //     'name' => 'Test User',
        //     'profile_picture' => 'https://i.pravatar.cc/300',
        //     'phone' => '081234567890',
        //     'is_admin' => '0'
        // ]);
        
        // Schedule::factory()
        //     ->count(10)
        //     ->create();

    }
}
