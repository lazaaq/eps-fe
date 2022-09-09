@extends('adminlte::page')

<!-- @section('title', 'RUKO') -->

@section('content_header')
<h1 class="m-0 text-dark">{{ __('adminlte::menu.dashboard') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3 col-12">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner text-center">
                                <h3>{{$paketTersedia}}</h3>

                                <p>PAKET TERSEDIA</p>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-12">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner text-center">
                                <h3>{{$paketDimiliki}}</h3>

                                <p>PAKET DIMILIKI</p>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-12">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner text-center">
                                <h3>{{$menungguKonfirmasi}}</h3>

                                <p>MENUNGGU KONFIRMASI PEMBAYARAN</p>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-12">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner text-center">
                                <h3>{{$menungguPembayaran}}</h3>

                                <p>Menunggu Pembayaran</p>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
            </div>
        </div>
    </div>
</div>
@stop
