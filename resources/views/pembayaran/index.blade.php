@extends('adminlte::page')

<!-- @section('title', 'RUKO') -->

@section('content_header')
<h1 class="m-0 text-dark">{{ __('adminlte::menu.pembayaran') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body" id="component-index">
                @include('pembayaran.component-index')
            </div>
        </div>
    </div>
</div>
@stop
@section('js')
<script src="{{asset('js/transaksi.js')}}"></script>
@endsection