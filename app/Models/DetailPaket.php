<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class DetailPaket extends Model
{
    use HasFactory;
    
    protected $table = 'packages';

    public function paket()
    {
        return $this->belongsTo('App\Models\Paket', 'quiz_type_id', 'id');
    }

    public function detailTransaksi()
    {
        return $this->hasMany('App\Models\DetailTransaksi', 'package_id', 'id');
    }
}
