<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Answer::create(['title' => 'Brown', 'question_id' => 1, 'isCorrect' => 1]);
        Answer::create(['title' => 'Green', 'question_id' => 1]);
        Answer::create(['title' => 'Blue', 'question_id' => 1]);
        Answer::create(['title' => 'Switzerland', 'question_id' => 2, 'isCorrect' => 1]);
        Answer::create(['title' => 'Sweden', 'question_id' => 2]);
        Answer::create(['title' => 'Finland', 'question_id' => 2]);
        Answer::create(['title' => 'Sprite', 'question_id' => 3]);
        Answer::create(['title' => 'Fanta', 'question_id' => 3]);
        Answer::create(['title' => 'Coca Cola', 'question_id' => 3, 'isCorrect' => 1]);
        Answer::create(['title' => 'Coffee', 'question_id' => 4]);
        Answer::create(['title' => 'Tea', 'question_id' => 4, 'isCorrect' => 1]);
        Answer::create(['title' => 'Coca Cola', 'question_id' => 4]);
        Answer::create(['title' => 'South Africa', 'question_id' => 5,  'isCorrect' => 1]);
        Answer::create(['title' => 'Sweden', 'question_id' => 5]);
        Answer::create(['title' => 'Finland', 'question_id' => 5]);
        Answer::create(['title' => 'Senegal', 'question_id' => 5,  'isCorrect' => 1]);
        Answer::create(['title' => 'Japan', 'question_id' => 5]);
    }
}
