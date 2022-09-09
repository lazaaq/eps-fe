<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Paket;
use App\Models\Topik;
use Auth;
use Str;
use DB;

class PaketController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter ?: null;
        $collagerId = Auth::user()->collager->id;
        $topiks = Topik::self();
        $data = DetailTransaksi::with('transaksi','detailPaket.paket')
        ->whereHas('transaksi', function($query) use($collagerId){
            $query->where('collager_id',$collagerId)
            ->where('status','STATUS_TRANS_2');
        })->get();

        return view('paket-saya.index',compact('data','topiks'));
    }

    public function show($namaPaket)
    {
        try {
            $namaPaket = Str::lower(str_replace('-',' ',$namaPaket));
            $data = Paket::self($namaPaket);

            if (empty($data)) {
                abort(404);
            }
        }
        catch (\Throwable $th) {
            abort(404);
        }
        return view('paket-saya.detail', compact('data'));
    }

    public function filter(Request $request)
    {
        $topik = $request->topik !== 'semua-topik' ? $request->topik:null;
        $collagerId = Auth::user()->collager->id;
        $data = DetailTransaksi::with('transaksi','detailPaket.paket')
        ->whereHas('transaksi', function($query) use($collagerId){
            $query->where('collager_id',$collagerId)
            ->where('status','STATUS_TRANS_2');
        })->when($topik, function($query) use($topik){
            $query->whereHas('detailPaket.paket', function($query) use($topik){
                $query->where('quiz_category_id',$topik);
            });
        })->get();
        return response()->json(['view'=>view('paket-saya.component-list-paket',compact('data'))->render()]);
    }
}
