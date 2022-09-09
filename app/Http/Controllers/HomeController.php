<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use App\Models\Paket;
use App\Models\Topik;
use App\Models\Quiz;
use App\Models\Banner;
use Carbon\Carbon;
use Auth;
use Str;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $filter = $request->filter ?: null;
        $collagerId = Auth::user()->collager->id;
        $topiks = Topik::self();
        $banner= Banner::where('isViewWeb',1)->get();
        $premium = DetailTransaksi::with('transaksi','detailPaket.paket')
        ->whereHas('transaksi', function($query) use($collagerId){
            $query->where('collager_id',$collagerId)
            ->where('status','STATUS_TRANS_2')
            ->where('start_date','<=',Carbon::now())
            ->where('expired_date','>=',Carbon::now());
        })->get()->sortBy(function($quert) {
            return $quert->detailPaket->paket->name;
        });

        $data=Paket::with('topik')->where('name','uji coba')->get();
        return view('paket-saya.index',compact('data','topiks','premium','banner'));
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
            ->where('status','STATUS_TRANS_2')
            ->where('start_date','<=',Carbon::now())
            ->where('expired_date','>=',Carbon::now());
        })->when($topik, function($query) use($topik){
            $query->whereHas('detailPaket.paket', function($query) use($topik){
                $query->where('quiz_category_id',$topik);
            });
        })->get();
        return response()->json(['view'=>view('paket-saya.component-list-paket',compact('data'))->render()]);
    }

    public function opening($id){
         
        $data=Quiz::findOrFail($id);
        $data=Quiz::where('id',$id)->get();
        
        return view('paket-saya.opening', compact('data'));
    }

    public function premium($namaPaket)
    {
        try {
            $namaPaket = Str::lower(str_replace('-',' ',$namaPaket));
            $data = Paket::premium($namaPaket);
            


            if (empty($data)) {
                abort(404);
            }
        }
        catch (\Throwable $th) {
            abort(404);
        }
        
        return view('paket-saya.detail', compact('data'));
         
        

    }
}
