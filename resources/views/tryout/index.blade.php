@extends('adminlte::page')



@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-10">
                            @if (session('user-quiz.section') =='membaca')
                            <h3>Membaca 읽기 </h3>
                            @else
                            <h3>Mendengar 듣기</h3>
                          @endif
                        </div>
                        <div class="col-lg-2">
                        <div class="row ">
                        <h3 style="padding: 0px 5px;margin-left:-35px" class=" border-2 bg-light "> sisa waktu &nbsp; </h3>
                        <h3 style="background-color:#1D3D73;color:white;padding:0px 10px;margin-left:-10px" id="timer"></h3>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-9">
                            <input type="hidden" name="quiz_id" id="quiz-id" value="{{$quiz->id}}">
                            @foreach ($data as $key => $question)
                            <div class="card">
                                <div class="card-header">
                                    <h4>Soal Nomor {{ $data->currentPage() }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <textarea class="form-control" style="border: none;height:150px" readonly>{{$question['question']}}</textarea>
                                        @if(!empty($question['pic_url']))
                                            <div style="margin-left: 250px"  class="col-lg-6 p-0 mt-1">
                                                <img style="width: 200px" src="{{config('apiurl.url').'/api/storage/question/'.$question['pic_url']}}" class="img-fluid rounded w-75" alt="Gambar soal">
                                            </div>
                                        @endif
                                        @if(!empty($question['audio_url']))
                                            <div class="col-lg-6 p-0 mt-1">
                                                <audio class="w-100" controls controlsList="nodownload" src="{{config('apiurl.url').'/storage/audio/question/'.$question['audio_url']}}">
                                                </audio>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="row">
                                            @foreach(collect($question['answer']) as $keyAnswer => $answer)
                                            @switch($answer['option'])
                                                @case('A')
                                                    @php $order = 'order-1 order-md-1'; @endphp
                                                    @break;
                                                @case('B')
                                                    @php $order = 'order-2 order-md-3'; @endphp
                                                    @break;
                                                @case('C')
                                                    @php $order = 'order-3 order-md-2'; @endphp
                                                    @break;
                                                @case('D')
                                                    @php $order = 'order-4 order-md-4'; @endphp
                                                    @break;
                                                @case('E')
                                                    @php $order = 'order-5 order-md-5'; @endphp
                                                    @break;
                                            @endswitch
                                            <div class="col-lg-6 col-md-12 {{$order}}">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-radio mb-2">
                                                            <input class="custom-control-input answer-option" type="radio" id="userAnswer{{$keyAnswer}}" name="userAnswer[{{$key}}]" data-no="{{$data->currentPage()}}" data-question-id="{{$question['id']}}" data-id="{{$answer['id']}}" value="{{$answer['option']}}" {{ session('user-quiz.answer-'.$section.'.'.$data->currentPage().'.0.option') == $answer['option'] ? 'checked':'' }}>
                                                            <label for="userAnswer{{$keyAnswer}}" class="custom-control-label">{{$answer['option'].'. '.$answer['content']}}</label>
                                                            @if(!empty($answer['pic_url']))
                                                            <div>
                                                                <img src="{{config('apiurl.url').'/storage/images/option/'.$answer['pic_url']}}" class="img-fluid w-25 rounded" alt="Opsi gambar">
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    {{ $data->links('vendor.pagination.simple-bootstrap-4') }}
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Nomor Soal</h4>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex flex-wrap justify-content-center align-items-center answer-map-container mb-3">
                                        @for($i=1;$i<=$data->total();$i++)
                                        <a href="{{$data->url($i)}}" class="btn m-1 btn-map {{ $data->currentPage() == $i ? 'btn-primary' : (session('user-quiz.answer-'.$section.'.'.$i.'.0.option') ? 'btn-success' : 'btn-default') }}">{{$i}}</a>
                                        @endfor
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-center">
                                    <div class="row ml-3">
                                    <div class="row col-12">
                                    <div style="width: 18px;height:18px;background-color:#1E9549"></div>
                                     <p style="font-size: 15px;margin-top:-3px"> &nbsp; : Sudah dijawab</p>
                                    </div>
                                    <br>
                                    <div class="row col-12">
                                    <div style="width: 18px;height:18px" class="bg-primary"></div>
                                     <p style="font-size: 15px;margin-top:-3px"> &nbsp; : Sedang dijawab</p>
                                    </div>
                                    <br>
                                    <div class="row col-12">
                                    <div style="width: 18px;height:18px" class="bg-white border border-2"></div>
                                     <p style="font-size: 15px;margin-top:-3px;"> &nbsp; : Belum dijawab </p>
                                    </div>
                                    </div>
                                    {{-- @if(session('user-quiz.section') == 'membaca')
                                    <button class="btn btn-danger m-1" id="btn-batal-tryout"></button>
                                    @else
                                    <button class="btn btn-secondary m-1" id="btn-selesai-tryout" disabled>Jawaban tersimpan automatis</button>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
<script src="{{asset('js/tryout.js')}}"></script>
@stop
