@extends('adminlte::page')

<!-- @section('title', 'RUKO') -->



@section('content')
<p style="font-size: 22px" class="ml-3 font-weight-bold"> HASIL TRYOUT {{' - '. $data->quiz->title }} </p>
<div class="row no-gutters">
    <div style="margin-top: -20px;" class="col-12">
        <div class="">
            <div class="card-body">
                <div class="mb-0 no-gutters">
                    <div class="d-flex flex-column mb-2">    
                        <p >{{$data->created_at->isoFormat('D MMMM Y H:MM')}}</p>
                    </div>
                    {{-- <a style="background-color: #039BB2;border-radius:10px" href="{{route('hasil-tryout.pdf',$data->id)}}" class="btn text-white font-weight-bold  btn-sm"><i class="fas fa-fw fa-download"></i>Unduh Hasil</a> --}}
                    <a style="background-color: #039BB2;border-radius:10px" href="{{route('paket-saya.show',str_replace(' ','-',Str::lower($data->quiz->paket->name)))}}" class="font-weight-bold btn text-white btn-sm"><i class="fas fa-fw fa-list"></i>Lihat Tes Lainnya</a>

                    <div class="row no-gutters ">
                        <div class="col-lg-12 no-gutters">
                            <div class="row justify-content-lg-center" >
                        <div class="col-lg-3 ">
                            <p class="font-weight-bold" style="font-size:20px;margin-left:25px;">Benar : {{$data->answer->where('isTrue',1)->count()}}  &nbsp; |  &nbsp;  Salah : {{$data->answer->where('isTrue',0)->count()}}  </p>
                            <div  style="width:220px;height:150px;border-radius:10px;margin-top:-15px;" class="border mb-5 ">
                                <div class="">
                                    <div class="justify-content-center text-center">
                                        <div style="background-color:#039BB2;height:53px;border-top-left-radius:10px;border-top-right-radius:10px" >
                                        
                                        </div>
                                        <h3 style="margin-top: -45px;color:white">Total Nilai</h3>
                                        <p style="font-size: 40px " class="mt-4 font-weight-bold">{{$data->total_score}}</p>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        </div>
                        
                        </div>
                        <p  style="font-size:14px;margin-left:35%;margin-top:-30px">(apabila total nilai diatas 180, anda lolos eps topik )</p>
                        <a style="margin-left:38%" target="_blank" href="https://forms.gle/KcqGk3TEhnHXJa6b7" class="btn alert-default-primary btn-sm "><i class="fas fa-fw fa-file-alt"></i><strong>Klik untuk mengisi testimoni</strong></a>
                        
                        {{-- <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column justify-content-center text-center">
                                        <strong>Benar</strong>
                                        <h3>{{$data->answer->where('isTrue',1)->count()}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                        {{-- <div class="col-lg-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-column justify-content-center text-center">
                                        <strong>Salah</strong>
                                        <h3>{{$data->answer->where('isTrue',0)->count()}}</h3>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="mt-5"id="component-hasil-tryout">
                    <div class="card shadow-none">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-striped" id="tabel-detail-hasil-tryout">
                                <thead style="background-color: #263B5E">
                                    <tr class="text-white">
                                        <th width="30">No</th>
                                        <th width="50">Tipe</th>
                                        <th>Soal</th>
                                        <th>Kunci Jawaban</th>
                                        <th>Jawaban Anda</th>
                                        <th width="50">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data->answer as $key => $item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$item->question->audio_url == NULL ? 'Membaca':'Mendengarkan'}}</td>
                                            <td>
                                                @if($item->question->audio_url == NULL)
                                                <textarea class="form-class w-100" style="border: none" readonly>{{$item->question->question}}</textarea>
                                                @else
                                                
                                                <audio class="form-class w-100" controls controlsList="nodownload" src="{{config('apiurl.url').'/storage/audio/question/'.$item->question->audio_url}}">
                                                </audio>
                                                @endif
                                            </td>
                                            <td>{{$item->question->answer->where('isTrue',1)->first()->option .'. '.$item->question->answer->where('isTrue',1)->first()->content}}</td>
                                            <td>{{$item->collager_answer ? $item->collager_answer .'. '.$item->question->answer->where('option',$item->collager_answer)->first()->content : '-'}}</td>
                                            <td>
                                                @if($item->isTrue)<span class="badge badge-success">Benar</span>
                                                @else<span class="badge badge-danger">Salah</span>@endif
                                            </td>
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
</div>
@stop

@section('plugins.Datatables', true)
@section('js')
    <script>
        $(function() {
            $("#tabel-detail-hasil-tryout").DataTable({
                "info": false,
                "lengthChange": false,
                "language": {
                    "paginate": {
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    },
                    "search": false,
                }
            });
        });
    </script>
@endsection
