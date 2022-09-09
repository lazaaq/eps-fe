<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'questions';

    public function answer()
    {
        return $this->hasMany('App\Models\Answer', 'question_id', 'id');
    }

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz', 'quiz_id', 'id');
    }
}
