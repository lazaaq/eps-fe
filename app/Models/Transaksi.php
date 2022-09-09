<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table        = 'transactions';
    protected $primaryKey   = 'id';
    protected $keyType      = 'string';
    public $incrementing    = false;
    public $timestamps      = true;
    protected $guarded      = ['created_at', 'updated_at'];

    public function detailTransaksi()
    {
        return $this->hasMany('App\Models\DetailTransaksi', 'transaction_id', 'id');
    }

    public function siswa()
    {
        return $this->belongsTo('App\Models\Siswa', 'collager_id', 'id');
    }

    public function metodeBayar()
    {
        return $this->belongsTo('App\Models\Komponen', 'payment_method', 'com_cd');
    }
    public function statusPembayaran()
    {
        return $this->belongsTo('App\Models\Komponen', 'status', 'com_cd');
    }
}
