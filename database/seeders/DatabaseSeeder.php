<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use App\Models\Schedule;
use Illuminate\Support\Facades\Log;
use App\Models\Address;
use App\Models\AttemptSchedule;
use App\Models\GroupQuestion;
use App\Models\Question;
use App\Models\QuestionBank;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::where('nim_or_nik','1201202020')->exists();
        if(!$user){
            User::factory()
                ->state(new Sequence(
                    [
                        'name' => 'admin',
                        'email' => 'admin@gmail.com',
                        'nim_or_nik' => '1201202020',
                        'is_admin' => '1'
                    ]
                ))->create();
            User::factory()
            ->state(new Sequence(
                [
                    'name' => 'user',
                    'email' => 'user@gmail.com',
                    'nim_or_nik' => '1201202000',
                    'is_admin' => '0'
                ]
            ))->create();
            User::factory(10)->create();
            Address::factory(11)->create();
        }

        if(QuestionBank::count() < 1){
            QuestionBank::factory(1)->create();
        }

        // if(Schedule::count() < 10){
        //     Schedule::factory(5)->create();
        // }

        // if(AttemptSchedule::count() < 10){
        //     AttemptSchedule::factory(5)->create();
        // }

    }
}
