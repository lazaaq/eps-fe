<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Quiz extends Model
{
    
    use SoftDeletes;
    use HasFactory;
    protected $table = 'quizs';

    public function question()
    {
        return $this->hasMany('App\Models\Question', 'quiz_id', 'id');
    }

    public function paket()
    {
        return $this->belongsTo('App\Models\Paket', 'quiz_type_id', 'id');
    }
}
