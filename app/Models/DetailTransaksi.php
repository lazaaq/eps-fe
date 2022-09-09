<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    use HasFactory;

    protected $table = 'transaction_details';
    public $incrementing = false;
    protected $keyType = 'string';

    public function transaksi()
    {
        return $this->belongsTo('App\Models\Transaksi', 'transaction_id', 'id');
    }

    public function detailPaket()
    {
        return $this->belongsTo('App\Models\DetailPaket', 'package_id', 'id');
    }
}
