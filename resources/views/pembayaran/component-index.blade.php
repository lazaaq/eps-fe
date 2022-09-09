<div class="row">
    <div class="col-lg-4 alert alert-default-primary order-1 order-md-2" style="display: table;">
        <h4>Metode Pembayaran</h4>
        <p class="text-justify mb-0" style="line-height: 23px;"> Pembayaran melalui transfer ke rekening
            yang ada sesuai dengan nominal pada invoice. <br><strong>Mohon untuk tidak membulatkan
                atau melebihkan nominal transfer.</strong></p>
    </div>
    <div class="col-lg-8 order-2 order-md-1">
        <ul class="row nav nav-pills pb-3" id="myTab" role="tablist">
            @foreach (\App\Models\Komponen::where('code_group','TRANS')->get()->sortBy('code_value') as $key => $value)
            <li class="nav-item col-lg-3 align-self-center text-center">
                <a id="{{$value->com_cd}}-tab" data-toggle="tab" href="#{{$value->com_cd}}" role="tab" aria-controls="{{$value->com_cd}}"
                @if($key == 0) class="nav-link active" aria-selected="true" @else class="nav-link" aria-selected="false" @endif>{{$value->code_nm}}</a>
            </li>
            @endforeach
        </ul>
        <div class="tab-content" id="myTabContent">
            @foreach (\App\Models\Komponen::where('code_group','TRANS')->get()->sortBy('code_value') as $key => $value)
            <div @if($key == 0) class="tab-pane fade show active" @else class="tab-pane fade" @endif id="{{$value->com_cd}}" role="tabpanel" aria-labelledby="{{$value->com_cd}}-tab">
                <?php
                    $transaksi = \App\Models\Transaksi::where('status',$value->com_cd)->where('collager_id',Auth::user()->collager->id)->get();
                ?>
                @if ($transaksi->count() <= 0)
                    <div class="container-fluid d-flex justify-content-center w-100">
                        <h5 class="font-weight-bold">Anda tidak memiliki transaksi dengan status yang dipilih.</h5>
                    </div>
                @endif
                @foreach ( $transaksi as $key2 => $value2)
                    <div class="callout callout-{{$value->note}} col-12">
                        <div class="position-relative p-3 bg-alpa">
                            <div class="ribbon-wrapper ribbon-xl">
                                <div class="ribbon bg-{{$value->note}}">
                                {{$value2->statusPembayaran->code_nm}}
                                </div>
                            </div>
                            <b class="text-bold">Tanggal Pembelian: {{\Carbon\Carbon::parse($value2->created_at)->isoFormat('D MMMM Y H:MM')}}</b>
                            <hr>
                            <a href=""></a>
                            <?php $url = \config('apiurl.url').'/img/logo-bank/'.$value2->metodeBayar->note2; ?>
                            <div class="row">
                                <div class="col-md-3">
                                    <img src="{{$url}}" alt="{{$value2->metodeBayar->code_nm}}" class="img-fluid mb-2" style="width:100%">
                                </div>
                                <div class="col-md-9">
                                    <b class="text-danger"> {{$value2->metodeBayar->code_value}} </b> <br> a/n<b class="text-danger">  {{$value2->metodeBayar->note}}</b>
                                </div>
                            </div>
                            <b>ID Pembayaran:</b> <a class="text-dark stretched-link" href="{{route('transaksi.show',$value2->id)}}" style="text-decoration:none">{{$value2->id}}</a><br>
                            <b>Total Pembayaran:</b> {{'Rp '.number_format($value2->amount_paid,0,".",".")}}<br>
                            @if($value2->status == 'STATUS_TRANS_1')
                            <hr>
                            <div>
                                <button type="button" class="btn bg-gradient-danger btn-xs btn-batalkan" data-id="{{$value2->id}}">Batalkan Pembayaran</button>
                                <button type="button" class="btn bg-gradient-primary btn-xs btn-konfirmasi" data-id="{{$value2->id}}">Konfirmasi Pembayaran</button>
                                @if($value2->proof_of_payment)
                                <?php $url = \config('apiurl.url').'/storage/images/proof_of_payment/'.$value2->proof_of_payment; ?>
                                <button type="button" class="btn bg-gradient-success btn-xs btn-lihat-bukti" data-id="{{$value2->id}}" data-img="{{$url}}">Lihat Bukti Pembayaran</button>
                                @endif
                            </div>
                            @elseif($value2->status == 'STATUS_TRANS_4')
                            <hr>
                            <div>
                                <button type="button" class="btn bg-gradient-primary btn-xs btn-unggah-ulang" data-id="{{$value2->id}}">Unggah Ulang Bukti Pembayaran</button>
                                @if($value2->proof_of_payment)
                                <?php $url = \config('apiurl.url').'/storage/images/proof_of_payment/'.$value2->proof_of_payment; ?>
                                <button type="button" class="btn bg-gradient-success btn-xs btn-lihat-bukti" data-id="{{$value2->id}}" data-img="{{$url}}">Lihat Bukti Pembayaran</button>
                                @endif
                            </div>
                            @else
                            <hr>
                            <div>
                                @if($value2->proof_of_payment)
                                <?php $url = \config('apiurl.url').'/storage/images/proof_of_payment/'.$value2->proof_of_payment; ?>
                                <button type="button" class="btn bg-gradient-success btn-xs btn-lihat-bukti" data-id="{{$value2->id}}" data-img="{{$url}}">Lihat Bukti Pembayaran</button>
                                @endif
                            </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            @endforeach
        </div>
    </div>
</div>
