@extends('adminlte::page')

<!-- @section('title', 'RUKO') -->


@section('content_header')
{{-- <h1 class="m-0 text-dark"><a href="{{route('paket-saya.index')}}"
class="text-dark">{{$data->topik->name}}</a>{{ ' - ' . $data->name }}</h1> --}}
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @foreach ($data as $quiz)
                    
                
                <div class="row d-flex justify-content-center">
                    <div class="text-center">
                        <h4 style="color:#263B5E">고용허가제 한국어 능력시험</h4>
                        <h4 style="font-size: 32px;color:#263B5E;"><b>EPS-TOPIK</b></h4>
                        <p style="color:#263B5E" class="p-1 mt-3">문항수 : {{$quiz->tot_visible}}문제 / 시험 시간 {{$quiz->timer_quiz}}분</p>
                        <p style="margin-top:-20px">Number of questions : {{$quiz->tot_visible}} questions / test time : {{$quiz->timer_quiz}} minutes</p>
                        <p>시험 일자 : 년 월 일 <br>Test date : <?php echo  date("d/m/Y");
                        ?> </p>
                        <p>문제지유형 : 1 형 <br>Test type : {{$quiz->paket->topik->name}}</p>
                    </div>
                </div>
                <div class="container-fluid">
                    <p style="font-size:16px">❶ 시작 지시가 있을 때까지 이 문제지를 펴지 마십시오.<br>&emsp;
                        Please do not open the test booklet until instructed to do so.
                    </p>
                    <p>❷ 응시번호와 성명을 문제지에 기재하여야 합니다<br>&emsp;
                        You should write the application number and name on the test paper sheet.
                    </p>
                    <p>❸ 각 페이지의 형별, 문항수 및 인쇄상태를 확인하고 이상이 있을 시 감독위원에게 말씀하여 주십시오.<br>&emsp;
                        Please check type, number of question and print condition of each page and if there is any
                        problem, report it to proctors immediately.
                    </p>
                </div>
                <div class="row justify-content-between">
                    <ul class="pagination">
                        <li  class="page-item"><a style="border-radius:29px;margin-left:30px;background-color:#039BB2;width:150px;height:45px" class="page-link text-white text-center" href="{{ url()->previous() }}"><i class="fa fa-backward mr-2" aria-hidden="true"></i>Kembali</a></li>
                    </ul>
                    <ul class="pagination justify-content-end">
                        <li class="page-item"><a  style="border-radius:29px;margin-right:30px;background-color:#039BB2;width:150px;height:45px" class="page-link text-white btn-mulai-tryout text-center" href="{{ route('tryout.index').'?session='.session()->getId().$quiz->id }}" data-kuis-id="{{$quiz->id}}">Lanjut<i class="fa fa-forward ml-2" aria-hidden="true"></i></a></li>
                    </ul>
                    
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="{{asset('js/prepare-tryout.js')}}"></script>
@stop
