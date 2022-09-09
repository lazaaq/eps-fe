<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class TryoutUser extends Model
{

    
    use HasFactory;
    protected $table = 'quiz_collagers';

    public function quiz()
    {
        return $this->belongsTo('App\Models\Quiz', 'quiz_id', 'id');
    }

    public function answer()
    {
        return $this->hasMany('App\Models\TryoutUserAnswer', 'quiz_collager_id', 'id');
    }
}
