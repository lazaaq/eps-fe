@extends('adminlte::page')

<!-- @section('title', 'RUKO') -->

@section('content_header')
<h1 class="m-0 text-dark"><a href="{{route('pembayaran.index')}}" class="text-dark">{{__('adminlte::menu.pembayaran')}}</a> - Detail Pembayaran</h1>
@stop

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="card shadow-none">
                    <div class="card-body table-responsive p-0">
                        <div class="row invoice-info">
                            <div class="col-sm-12 alert alert-default-primary">
                                <h4>Cara Pembayaran</h4>
                                <p class="text-justify mb-0" style="line-height: 23px;"> Pembayaran melalui transfer ke rekening
                                    <b>{{$data->metodeBayar->code_nm}}</b> dengan nomor rekening <b>{{$data->metodeBayar->code_value}}</b> a/n <b>{{$data->metodeBayar->note}}</b>
                                    sebesar nominal yang tertera pada invoice (<b>{{'Rp '.number_format($data->amount_paid,0,".",".")}}</b>). Upload bukti pembayaran pada sistem agar membantu admin dalam mengkonfirmasi pembayaran.
                                    <br><strong>Mohon untuk tidak membulatkan
                                    atau melebihkan nominal transfer.</strong></p>
                            </div>
                            <div class="col-sm-12 invoice-col">
                                <small class="float-right">Tanggal: {{\Carbon\Carbon::parse($data->created_at)->isoFormat('D MMMM Y')}}</small>
                                <div>
                                        @if($data->status == 'STATUS_TRANS_1')
                                        <button type="button" class="btn bg-gradient-danger btn-xs btn-batalkan" data-id="{{$data->id}}">Batalkan Pembayaran</button>
                                        <button type="button" class="btn bg-gradient-primary btn-xs btn-konfirmasi" data-id="{{$data->id}}">Konfirmasi Pembayaran</button>
                                        @if($data->proof_of_payment)
                                        <?php $url = \config('apiurl.url').'/storage/images/proof_of_payment/'.$data->proof_of_payment; ?>
                                        <button type="button" class="btn bg-gradient-success btn-xs btn-lihat-bukti" data-id="{{$data->id}}" data-img="{{$url}}">Lihat Bukti Pembayaran</button>
                                        @endif
                                    @elseif($data->status == 'STATUS_TRANS_4')
                                        <button type="button" class="btn bg-gradient-primary btn-xs btn-unggah-ulang" data-id="{{$data->id}}">Unggah Ulang Bukti Pembayaran</button>
                                        @if($data->proof_of_payment)
                                        <?php $url = \config('apiurl.url').'/storage/images/proof_of_payment/'.$data->proof_of_payment; ?>
                                        <button type="button" class="btn bg-gradient-success btn-xs btn-lihat-bukti" data-id="{{$data->id}}" data-img="{{$url}}">Lihat Bukti Pembayaran</button>
                                        @endif
                                    @else
                                        @if($data->proof_of_payment)
                                        <?php $url = \config('apiurl.url').'/storage/images/proof_of_payment/'.$data->proof_of_payment; ?>
                                        <button type="button" class="btn bg-gradient-success btn-xs btn-lihat-bukti" data-id="{{$data->id}}" data-img="{{$url}}">Lihat Bukti Pembayaran</button>
                                        @endif
                                    @endif
                                </div>
                                <b>ID Pembayaran:</b> {{$data->id}}<br>
                                <b>Total:</b> {{'Rp '.number_format($data->amount_paid,0,".",".")}}<br>
                                <b>Metode Pembayaran:</b> {{$data->metodeBayar->code_nm}} ({{$data->metodeBayar->code_value}} - {{$data->metodeBayar->note}})<br>
                                <b>Status Pembayaran:</b> {{$data->statusPembayaran->code_nm}}
                            </div>
                        </div>
                        <table class="table table-hover text-nowrap mt-2 table-striped">
                            <thead class="bg-lightblue">
                                <tr>
                                    <th width="30">#</th>
                                    <th>Topik</th>
                                    <th>Paket</th>
                                    <th class="text-right">Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data->detailTransaksi as $key => $item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->detailPaket->paket->topik->name}}</td>
                                    <td>{{$item->detailPaket->paket->name}}</td>
                                    <td class="text-right" data-price="{{$item->price}}">{{'Rp '.number_format($item->price,0,".",".")}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="{{asset('js/cart.js')}}"></script>
<script src="{{asset('js/transaksi.js')}}"></script>
@endsection
