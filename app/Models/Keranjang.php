<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'cart';

    public function detailPaket()
    {
        return $this->belongsTo('App\Models\DetailPaket', 'package_id', 'id');
    }
}
