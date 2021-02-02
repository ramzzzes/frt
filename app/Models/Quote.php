<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;

    protected $table = 'quote';
    protected $fillable = [
        'quiz_id',
        'question',
        'type'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
        'quiz_id',
    ];

    const type = [
        'boolean' => 0,
        'multiple' => 1
    ];

    public function getTypeAttribute($value)
    {
        return array_flip($this::type)[$value];
    }

    public function answers()
    {
        return $this->hasMany(Answer::class,'quote_id','id');
    }
}
