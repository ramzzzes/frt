<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Quiz;
use App\Models\Quote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $quiz = Quiz::create([
            'name' => 'Best Quotes of All Time',
        ]);

        $quote = Quote::create([
            'quiz_id' => $quiz->id,
            'question' => 'Spread love everywhere you go. Let no one ever come to you without leaving happier',
            'type' => Quote::type['multiple']
        ]);

        Answer::insert([
            [
                'quote_id' => $quote->id,
                'answer' => 'Franklin D. Roosevelt',
                'right' => Answer::false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'quote_id' => $quote->id,
                'answer' => 'Mother Teresa',
                'right' => Answer::right,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'quote_id' => $quote->id,
                'answer' => 'Robert Louis Stevenson',
                'right' => Answer::false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);

        $quote = Quote::create([
            'quiz_id' => $quiz->id,
            'question' => 'It is during our darkest moments that we must focus to see the light',
            'type' => Quote::type['multiple']
        ]);

        Answer::insert([
            [
                'quote_id' => $quote->id,
                'answer' => 'Aristotle',
                'right' => Answer::right,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'quote_id' => $quote->id,
                'answer' => 'Anne Frank',
                'right' => Answer::false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'quote_id' => $quote->id,
                'answer' => 'Eleanor Roosevelt',
                'right' => Answer::false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);

        $quote = Quote::create([
            'quiz_id' => $quiz->id,
            'question' => 'as Benjamin Franklin said : Tell me and I forget. Teach me and I remember. Involve me and I learn',
            'type' => Quote::type['boolean']
        ]);

        Answer::insert([
            [
                'quote_id' => $quote->id,
                'answer' => 'Yes',
                'right' => Answer::right,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],[
                'quote_id' => $quote->id,
                'answer' => 'No',
                'right' => Answer::false,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ]);

    }
}
