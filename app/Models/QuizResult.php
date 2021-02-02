<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
    use HasFactory;

    protected $table = 'quiz_results';
    protected $fillable = [
        'quote_id',
        'quiz_session_id',
        'answer_id'
    ];
}
