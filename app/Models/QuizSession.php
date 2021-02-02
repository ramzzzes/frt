<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizSession extends Model
{
    use HasFactory;

    protected $table = 'quiz_sessions';
    protected $fillable = [
        'quiz_id',
        'session'
    ];

    public function quiz()
    {
        return $this->hasOne(Quiz::class,'id','quiz_id');
    }

    public function result()
    {
        return $this->hasMany(QuizResult::class,'quiz_session_id','id');
    }

    public function handle($session,$quote,$answer)
    {
        //validation starts

        $quizSession = self::query()->where('session',$session)->with('quiz.quotes.answers')->first();

        if(!$quizSession){
            throw new \Exception('Quiz not found',404);
        }

        $availableQuoteIdList = collect($quizSession->quiz->quotes)->pluck('id')->toArray();

        if(!in_array($quote,$availableQuoteIdList)){
            throw new \Exception('Invalid quote id',404);
        }

        $availableQuotesWithAnswersArray = collect($quizSession->quiz->quotes)->pluck('answers','id')->toArray();
        $availableAnswerIdList = collect($availableQuotesWithAnswersArray[$quote])->pluck('id')->toArray();


        if(!in_array($answer,$availableAnswerIdList)){
            throw new \Exception('Invalid answer id',404);
        }

        //validation ends


        $quizResult = QuizResult::query()
            ->where('quiz_session_id', $quizSession->id)
            ->where('quote_id', $quote)
            ->first();


        if($quizResult){
            throw new \Exception('you already answered this quote',301);
        }

        QuizResult::query()->create([
            'quiz_session_id' => $quizSession->id,
            'quote_id' => $quote,
            'answer_id' => $answer
        ]);


        $result = 'Sorry, wrong answer';
        foreach ($availableQuotesWithAnswersArray[$quote] as $a) {
            if($a['id'] == $answer && $a['right'] == Answer::right){
                $result = 'Correct Answer';
            }
        }


        return $result;

    }

    public function results($session)
    {
        $quizSession = self::query()->where('session',$session)->with(['quiz.quotes.answers','result'])->first();

        if(!$quizSession){
            throw new \Exception('Quiz not found',404);
        }

        if(count($quizSession->quiz->quotes) != count($quizSession['result'])){
            throw new \Exception('you have not finished yet');
        }

        $availableQuotesWithAnswersArray = collect($quizSession->quiz->quotes)->pluck('answers','id')->toArray();
        $rightAnswerWithQuote = [];

        foreach ($availableQuotesWithAnswersArray as $k=>$quote) {
            foreach ($quote as $answer) {
                if($answer['right'] == Answer::right){
                    $rightAnswerWithQuote[$k] = $answer['id'];
                }
            }
        }


        $rightAnswerCount = 0;

        foreach ($quizSession['result'] as $result) {
            if($rightAnswerWithQuote[$result['quote_id']] == $result['answer_id']){
                $rightAnswerCount++;
            }
        }

        return [
            'quotes' => count($availableQuotesWithAnswersArray),
            'right' => $rightAnswerCount
        ];
    }
}
