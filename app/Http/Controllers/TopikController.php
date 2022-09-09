<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topik;
use App\Models\Paket;
use App\Models\DetailPaket;
use App\Models\Keranjang;
use App\User;
use App\Models\DetailTransaksi;
use App\Models\Transaksi;
use DB;
use Str;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TopikController extends Controller
{
    public function index()
    {
        $data = Topik::self();
        return view('topik.index', compact('data'));
    }

    public function show(Request $request, $namaTopik)
    {
        try {
            $namaTopik = Str::lower(str_replace('-',' ',$namaTopik));
            $id = $request->id ?: null;
            $topik = Topik::self()->filter(function ($item) use ($namaTopik) {
                return false !== stripos(Str::lower($item->name), $namaTopik);
            })->when($id, function($query) use($id){
                return $query->where('id',$id);
            })->first();

            $data = Paket::with('detailPaket')
                        ->has('detailPaket')
                        ->whereHas('topik', function($query) use($topik){
                            $query->where('id',$topik->id);
                    })->get();
        }
        catch (\Throwable $th) {
            abort(404);
        }
        return view('topik.daftar-paket', compact('data','topik'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'paket' => 'required|unique:cart,package_id'
        ]);

        $paket_id = $request->paket;
        $transaksi = Transaksi::where('status','!=','STATUS_TRANS_3')
                    ->where('collager_id',Auth::user()->collager->id)
                    ->whereHas('detailTransaksi', function($query) use($paket_id){
                        $query->where('package_id',$paket_id);
                    })->get();
        if ($validator->fails()) {
            return response()->json("Paket ini sudah ada di keranjang", 422);
        } else if($transaksi->isNotEmpty()){
            return response()->json("Paket ini tidak dapat ditambahkan pada keranjang", 422);
        }

        $data = new Keranjang;
        $data->package_id = $request->paket;
        $data->price = DetailPaket::find($request->paket)->price;
        $data->user_id = Auth::id();
        $data->save();

        $jumlahItem = Auth::user()->keranjang->count();
        return response()->json(['jumlahItem'=>$jumlahItem]);
    }
}
