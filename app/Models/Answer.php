<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $table = 'answer';
    protected $fillable = [
        'quote_id',
        'answer',
        'right'
    ];
    protected $hidden = [
        'quote_id',
        'created_at',
        'updated_at',
    ];

    const false = 0;
    const right = 1;

}
