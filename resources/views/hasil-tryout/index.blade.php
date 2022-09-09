@extends('adminlte::page')

<!-- @section('title', 'RUKO') -->

@section('content_header')
<h1 class="m-0 text-dark">{{ __('adminlte::menu.hasil_try_out') }}</h1>
@stop

@section('content')
<div class="row no-gutters">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-3"><strong>Berikut hasil pengerjaan try out yang pernah Anda lakukan</strong></div>
                <hr>
                <div id="component-hasil-tryout">
                    @if($data->isEmpty())
                    <div class="container-fluid mt-4 d-flex justify-content-center w-100">
                        <h5 class="font-weight-bold">Hasil try out Anda masih kosong.</h5>
                    </div>
                    @else
                    <div class="card shadow-none">
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-striped" id="tabel-hasil-tryout">
                                <thead style="background-color: #263B5E">
                                    <tr class="text-white">
                                        <th width="30">No</th>
                                        <th>Tanggal</th>
                                        <th>Topik</th>
                                        <th>Try Out</th>
                                        <th>Skor</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $key => $item)
                                    <tr>
                                        <td class="text-center">{{$key+1}}</td>
                                        <td>{{$item->created_at->isoFormat('D MMMM Y H:MM')}}</td>
                                        <td>{{$item->quiz->paket->topik->name}}</td>
                                        <td>{{$item->quiz->title}}</td>
                                        <td>{{$item->total_score}}</td>
                                        <td>
                                            <a href="{{route('hasil-tryout.show',$item->id)}}" class="btn btn-info">Review</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
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
            $("#tabel-hasil-tryout").DataTable({
                "info": false,
                "lengthChange": false,
                "language": {
                    "paginate": {
                        "next": "Berikutnya",
                        "previous": "Sebelumnya"
                    },
                    "search": "Cari:"
                }
            });
        });
    </script>
@endsection
