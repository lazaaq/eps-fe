@if($data->isEmpty())
<div class="container-fluid d-flex justify-content-center w-100">
    <h5 class="font-weight-bold">Anda belum memiliki paket.</h5>
</div>
@else

@foreach($data as $paket)
<div class="col-lg-3 col-sm-6 ">
    <a href="{{route('paket-saya.show',str_replace(' ','-',Str::lower($paket->name)))}}">
    <div  style=""class="card h-100">
        <div class="card-body ">
            <div class="d-flex justify-content-center text-center">
                <div class="ml-0 pt-4">
                   <a class="btn alert-default-primary btn-sm stretched-link"  href="{{route('paket-saya.show',str_replace(' ','-',Str::lower($paket->name)))}}"> <h4  style=";color: #263B5E"class="mb-0 font-weight-bold ">{{$paket->topik->name}}</h4></a>
                    <hr style="border-top:2px solid #263B5E;width:200px">
                    <p class="mt-2">10 PAKET LATIHAN)<br>
                            (10개 연습패키지)<br>
                            Membaca 읽기 : 20 Soal 문장  <br> Mendengar 듣기 : 20 Soal 문장 <br>
                            문항수 : 40문제 / 시험 시간 50분 </p>
                    {{-- <p>{{Str::limit($paket->description, 100)}}</p> --}}
                </div>
                {{-- <div class="ml-3 align-self-start">
                    <a href="{{route('paket-saya.show',str_replace(' ','-',Str::lower($paket->name)))}}" class="btn alert-default-primary btn-sm stretched-link"><i class="fas fa-fw fa-list"></i></a>
                </div> --}}
            </div>
        </div>
    </div>
    </a>
</div>
@endforeach
@foreach($premium as $data)
<div class="col-lg-3 col-sm-6 p-2">
    <div class="card h-100">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <div class="ml-0">
                    <h4 class="mb-0 font-weight-bold">{{$data->detailPaket->paket->name}}</h4>
                    <p>10 PAKET LATIHAN)<br>
                            (10개 연습패키지)<br>
                            Membaca 읽기 : 20 Soal 문장 Menyimak 듣기 : 20 Soal
                            문항수 : 40문제 / 시험 시간 50분</p>
                    {{-- <p>{{Str::limit($data->detailPaket->paket->description, 100)}}</p> --}}
                </div>
                <div class="ml-3 align-self-start">
                    <a href="{{route('paket-saya.premium',str_replace(' ','-',Str::lower($data->detailPaket->paket->name)))}}" class="btn alert-default-primary btn-sm stretched-link"><i class="fas fa-fw fa-list"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endif
