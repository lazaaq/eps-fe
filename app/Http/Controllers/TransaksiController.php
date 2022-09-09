<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\DetailTransaksi;
use Auth;
use Validator;
use DB;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
        [
            'metode_bayar' => 'required',
        ]);
        $amount_paid = Auth::user()->keranjang->sum('price');
        
        DB::beginTransaction();
        $newTransactionId = 'TR'.Carbon::now()->format('ymdHis').rand(100,999);
        $data = new Transaksi;
        $data->id = $newTransactionId;
        $data->collager_id = Auth::user()->siswa->id;
        $data->unique_payment = rand(100,999);
        $data->payment_method = $request->metode_bayar;
        $data->status = 'STATUS_TRANS_1'; //WAITING PAYMENT
        $data->amount_paid = $amount_paid - 1000 + $data->unique_payment;
        $data->save();
        
        $keranjang = Auth::user()->keranjang;
        foreach ($keranjang as $key => $value) {
            $dataDetail = new DetailTransaksi;
            $dataDetail->id = 'DTR'.Carbon::now()->format('ymdHi').rand(1000,9999);
            $dataDetail->transaction_id = $newTransactionId;
            $dataDetail->package_id = $value->package_id;
            $dataDetail->price = $value->price;
            $dataDetail->save();
            $value->delete();
        }
        DB::commit();
        return redirect()->route('transaksi.show',$newTransactionId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Transaksi::with('detailTransaksi')->find($id);
        // dd($data);
        return view('pembayaran.detail',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function batal(Request $request)
    {
        $this->validate($request,
        [
            'id' => 'required',
        ]);
        
        DB::beginTransaction();
        $data = Transaksi::find($request->id);
        $data->status = 'STATUS_TRANS_3'; //FAILED
        $data->save();
        DB::commit();
        return response()->json([
            'status'=>'success',
            'message'=>'Transaksi dibatalkan.',
            'view'=>view('pembayaran.component-index')->render()
        ]);
        // return response()->json(['view'=>view('pembayaran.component-index')->render()]);
    }
    public function unggahBukti(Request $request)
    {
        $this->validate($request,
        [
            'id' => 'required',
            'bukti_pembayaran' => 'required',
        ]);

        // if(!empty($request->bukti_pembayaran)){
        //     $file = $request->file('bukti_pembayaran');
        //     $extension = strtolower($file->getClientOriginalExtension());
        //     $filename = uniqid() . '.' . $extension;
        //     \Storage::put('public/images/bukti-bayar/' . $filename, \File::get($file));
        // }
        if ($request->hasFile('bukti_pembayaran')) {
            if($request->file('bukti_pembayaran')->isValid()) {
                $file = $request->file('bukti_pembayaran');
                $foto = base64_encode(file_get_contents($request->file('bukti_pembayaran')));
                $filename = Carbon::now()->format('ymdHis').rand(100,999);
                $upload_foto = app('App\Http\Controllers\UploadFotoController')->uploadFoto($foto,'\App\Transaction',$request->id,'images/proof_of_payment',$filename);
            }
        }
        
        DB::beginTransaction();
        $data = Transaksi::find($request->id);
        $data->status = 'STATUS_TRANS_4'; //MENUNGGU KONFIRMASI
        $data->proof_of_payment = $filename. '.' . 'jpg';
        $data->save();
        DB::commit();
        return response()->json([
            'status'=>'success',
            'message'=>'Berhasil mengunggah bukti pembayaran. Pembayaran akan dikonfirmasi admin.',
            'view'=>view('pembayaran.component-index')->render()
        ]);
        // return response()->json(['view'=>view('pembayaran.component-index')->render()]);
    }
}
