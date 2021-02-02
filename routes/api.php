<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'namespace'=> '\App\Http\Controllers\Api',
], function(){
    Route::post('/quiz/start', 'QuizController@start');
    Route::post('/quiz/{session}', 'QuizController@answer');
    Route::get('/quiz/{session}/result', 'QuizController@result');
});
