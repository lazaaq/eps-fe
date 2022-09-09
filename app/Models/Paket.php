<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;

class Paket extends Model
{
    
    use HasFactory;
    protected $table = 'quiz_types';

    public function detailPaket()
    {
        return $this->hasOne('App\Models\DetailPaket', 'quiz_type_id', 'id');
    }

    public function topik()
    {
        return $this->belongsTo('App\Models\Topik', 'quiz_category_id', 'id');
    }

    public function quiz()
    {
        return $this->hasMany('App\Models\Quiz', 'quiz_type_id', 'id');
    }

    public static function self($namaPaket)
    {
        return self::with('quiz')->where(DB::raw('lower(name)'), 'like', '%'.$namaPaket.'%')
        // ->whereHas('detailPaket.detailTransaksi.transaksi', function($query){
        //     $query->where('status','STATUS_TRANS_2')->where('collager_id',Auth::user()->collager->id);
        // })
        ->first();
    }
    public static function premium($namaPaket)
    {
        return self::with('quiz')->where(DB::raw('lower(name)'), 'like', '%'.$namaPaket.'%')
        ->whereHas('detailPaket.detailTransaksi.transaksi', function($query){
            $query->where('status','STATUS_TRANS_2')->where('collager_id',Auth::user()->collager->id);
        })
        ->first();
    }
}
