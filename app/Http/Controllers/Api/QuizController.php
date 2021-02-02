<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StartQuiz;
use App\Models\Quiz;
use App\Models\QuizResult;
use App\Models\QuizSession;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    /**
     * @param Request $request
     * @param Quiz $quiz
     * @return StartQuiz|\Illuminate\Http\JsonResponse
     */
    public function start()
    {
        try{
            $session = md5(microtime());
            $quiz = Quiz::query()
                ->inRandomOrder()
                ->with('quotes.answers')
                ->limit(1)
                ->first();

            QuizSession::create([
                'session' => $session,
                'quiz_id' => $quiz->id
            ]);

            return new StartQuiz($quiz,$session);
        }catch (\Exception $e){
            return response()->json($e->getMessage(),$e->getCode());
        }
    }

    public function answer($session,QuizSession $quizSession,Request $request)
    {
        try{
            $response = $quizSession->handle(
                $session,
                $request->post('quote'),
                $request->post('answer'),
            );

            return response()->json($response);
        }catch (\Exception $e){
            return response()->json($e->getMessage(),$e->getCode());
        }
    }

    public function result($session,QuizSession $quizSession,Request $request)
    {
        try{
            $response = $quizSession->results($session);
            return response()->json($response);
        }catch (\Exception $e){
            return response()->json($e->getMessage(),500);
        }
    }
}
