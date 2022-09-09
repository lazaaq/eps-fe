<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollagerUser extends Model
{
    use HasFactory;

    protected $table = 'collagers';

    public function tryout()
    {
        return $this->hasMany('App\Models\TryoutUser', 'collager_id', 'id');
    }
}
