@extends('adminlte::page')

<!-- @section('title', 'RUKO') -->

{{-- @section('content_header')
<h1 class="m-0 text-dark"><a href="{{route('paket-saya.index')}}" class="text-dark">{{$data->topik->name}}</a></h1>
@stop --}}

@section('content')
<div  style="background: url('../img/bg.png') no-repeat ;padding:0px 0px;background-size:cover;background-position:center;margin:0px">
<div style="padding:0px 0px" class=" justify-content-center mb-5  ">
    <div class="text-center ">
        <h3 class="font-weight-bold" style="color:black ">Selamat Datang di</h3>
        <h3 class="font-weight-bold" style="color:black "> {{$data->topik->name}}</h3>
    </div>
</div>
<div class="row justify-content-center pb-4">
    <div class="col-10">
        
            <div class="">
                <div class="row justify-content-center ">
                    @if($data->quiz->isEmpty())
                    <div class="container-fluid d-flex justify-content-center w-100">
                        <h5 class="font-weight-bold">Paket ini belum memiliki kuis</h5>
                    </div>
                    @else
                    @foreach($data->quiz as $quiz)
                    <div style="width: 200px " class="mr-3 mt-3">
                        <div  class="card h-100">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-start">
                                    <div class="ml-0">
                                        <h4 class="mb-0 font-weight-bold">{{$quiz->title}}</h4>
                                        <p class="card-text">Membaca 읽기 dan Mendengar 듣기</p>
                                        <span class="text-muted">Jumlah : {{$quiz->tot_visible}} Soal</span>
                                        <br>
                                        <span class="text-muted">Waktu : {{$quiz->timer_quiz}} Menit</span>
                                    </div>
                                    <div class="ml-0 mt-2">
                                        {{-- @if(\App\Models\TryoutUser::where('quiz_id',$quiz->id)->where('collager_id',Auth::user()->collager->id)->get()->isNotEmpty())
                                        <span class="badge badge-info">SUDAH DIKERJAKAN</span>
                                        @else --}}
                                        {{-- <a href="{{ route('tryout.index').'?session='.session()->getId().$quiz->id }}" data-kuis-id="{{$quiz->id}}" class="btn alert-default-primary btn-sm btn-mulai-tryout"><i class="fas fa-fw fa-file-alt"></i><strong>Kerjakan</strong></a> --}}
                                         <a href="{{route('paket-saya.opening',$quiz->id)}}" class="btn alert-default-primary btn-sm stretched-link"><i class="fas fa-fw fa-file-alt"></i><strong>Kerjakan</strong></a>
                                        {{-- @endif --}}
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
@section('footer')
@include('adminlte::partials.footer.footer')
    
@endsection

@section('js')
<script src="{{asset('js/prepare-tryout.js')}}"></script>
@stop
