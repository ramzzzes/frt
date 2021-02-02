<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;
    protected $table = 'quiz';
    protected $fillable = [
        'name'
    ];
    protected $hidden = [
      'created_at',
      'updated_at'
    ];

    public function quotes()
    {
        return $this->hasMany(Quote::class,'quiz_id','id');
    }
}
