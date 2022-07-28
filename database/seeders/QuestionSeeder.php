<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Question::create([
            'title' => 'What is the rarest M&M color?',
            'quiz_id' => 1
        ]);
        Question::create([
            'title' => 'Which country consumes the most chocolate per capita?',
            'quiz_id' => 1
        ]);
        Question::create([
            'title' => 'What was the first soft drink in space?',
            'quiz_id' => 1
        ]);
        Question::create([
            'title' => 'What is the most consumed manufactured drink in the world?',
            'quiz_id' => 1
        ]);
        Question::create([
            'title' => 'Which of the following countries has never hosted OS?',
            'quiz_id' => 1,
            'isMultipleChoice' => 1
        ]);
    }
}
