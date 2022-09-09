<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table    = 'collagers';
    public $timestamps  = true;
    protected $guarded  = ['created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function transaksi()
    {
        return $this->hasMany('App\Models\Transaksi', 'collager_id', 'id');
    }
}
