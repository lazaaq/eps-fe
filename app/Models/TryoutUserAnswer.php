<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryoutUserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'quiz_collager_id',
        'question_id',
        'collager_answer',
        'isTrue',
        'score'
    ];

    protected $table = 'quiz_collager_answers';

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id', 'id');
    }
}
