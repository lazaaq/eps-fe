@extends('adminlte::page')

<!-- @section('title', 'RUKO') -->

@section('content_header')
<h1 class="m-0 text-dark"><a href="{{route('topik.index')}}" class="text-dark">Paket</a>{{ ' - ' . $topik->name }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    @if($data->isEmpty())
                    <div class="container-fluid d-flex justify-content-center w-100">
                        <h5 class="font-weight-bold">Belum ada paket tersedia.</h5>
                    </div>
                    @else
                    @foreach($data as $paket)
                    <div class="col-lg-3 col-sm-6 p-2">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="ml-0">
                                        <h4 class="mb-0 font-weight-bold">{{$paket->name}}</h4>
                                        <p class="mb-0 card-text">{{$paket->description}}</p>
                                        <p class="mt-0 mb-0 card-text">Harga :</p>
                                        <h5 class="card-text">{{$paket->detailPaket->price}}</h5>
                                    </div>
                                    <div class="ml-3 align-self-start">
                                        <button data-paket-id="{{$paket->detailPaket->id}}" class="btn bg-lightblue btn-sm stretched-link btn-keranjang"><i class="fas fa-fw fa-shopping-cart"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="{{asset('js/paket.js')}}"></script>
@endsection
