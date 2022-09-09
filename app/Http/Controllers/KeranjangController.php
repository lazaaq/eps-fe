<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Keranjang;
use Auth;

class KeranjangController extends Controller
{
    public function index()
    {
        $data = Keranjang::where('user_id',Auth::id())->get();
        return view('keranjang.index',compact('data'));
    }

    public function destroy(Request $request)
    {
        Keranjang::where('package_id',$request->paket)->firstOrFail()->delete();

        $data = Keranjang::all();
        $jumlahItem = Auth::user()->keranjang->count();
        return response()->json(['view'=>view('keranjang.component',compact('data'))->render(),'jumlahItem'=>$jumlahItem]);
    }
}
