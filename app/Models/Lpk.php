<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lpk extends Model
{
    use HasFactory;

    protected $table = 'lpk';
    public $timestamps = true;
    protected $guarded = ['created_at', 'updated_at'];
    protected $primaryKey = 'id';
    protected $keyType = 'string';
}
