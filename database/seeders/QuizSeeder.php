<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Quiz::create([
            'name' => 'Staring Quiz',
            'description' => 'Welcome to this quiz application. Every page contains up to 3 questions and all questions on the
                        current page needs to be answered to continue to the next page. Good luck!'
        ]);
    }
}
