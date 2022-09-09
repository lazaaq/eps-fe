@extends('adminlte::page')

<!-- @section('title', 'RUKO') -->

@section('content_header')
<h1 class="m-0 text-dark">{{ __('adminlte::menu.topik') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    @if($data->isEmpty())
                    <div class="container-fluid d-flex justify-content-center w-100">
                        <h5 class="font-weight-bold">Belum ada topik tersedia.</h5>
                    </div>
                    @else
                    @foreach($data as $topik)
                    <div class="col-lg-3 col-sm-6 p-2">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="ml-0">
                                        <h4 class="mb-0 font-weight-bold">{{$topik->name}}</h4>
                                        <p>{{Str::limit($topik->description, 100)}}</p>
                                    </div>
                                    <div class="ml-3 align-self-start">
                                        <a href="{{route('topik.show',str_replace(' ','-',Str::lower($topik->name))).'?id='.$topik->id}}" class="btn alert-default-primary btn-sm stretched-link"><i class="fas fa-fw fa-list"></i></a>
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
