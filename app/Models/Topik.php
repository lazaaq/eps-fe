<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;

class Topik extends Model
{
    
    use HasFactory;
    protected $table = 'quiz_categorys';

    public function paket()
    {
        return $this->hasMany('App\Models\Paket', 'quiz_category_id', 'id');
    }

    public static function self()
    {
        return self::where(DB::raw('lower(root)'), 'like', '%try out%')
        ->where(function($query){
            $query->where('lpk', Auth::user()->lpk);
            $query->orWhereNull('lpk');
        })->get();
    }
    public static function gratis()
    {
        return self::where(DB::raw('lower(root)'), 'like', '%gratis%')
        ->where(function($query){
            $query->where('lpk', Auth::user()->lpk);
            $query->orWhereNull('lpk');
        })->get();
    }
}
