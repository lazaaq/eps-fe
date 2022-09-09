@extends('adminlte::page')

<!-- @section('title', 'RUKO') -->

@section('content_header')
<h1 class="m-0 text-dark">{{ __('Profil') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
                <form action="{{route('profil.update')}}" method="post">
                @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama_lengkap" value={{$data->name}}>
                            @if($errors->has('nama_lengkap'))
                                <div class="">
                                    <strong class="text-danger">{{ $errors->first('nama_lengkap') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" class="form-control" name="username" value={{$data->username}}>
                            @if($errors->has('username'))
                                <div class="">
                                    <strong class="text-danger">{{ $errors->first('username') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" name="email" value={{$data->email}}>
                            @if($errors->has('email'))
                                <div class="">
                                    <strong class="text-danger">{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">LPK</label>
                            <select name="lpk" id="lpk" name="lpk" class="form-control {{ $errors->has('lpk') ? 'is-invalid' : '' }}" autofocus>
                                <option></option>
                                @foreach(\App\Models\Lpk::all() as $lpk)
                                <option value="{{$lpk->id}}" {{(collect(old('lpk'))->contains($lpk->id)) ? 'selected':''}} @if($data->lpk == $lpk->id) selected='selected' @endif>{{$lpk->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('lpk'))
                                <div class="">
                                    <strong class="text-danger">{{ $errors->first('lpk') }}</strong>
                                </div>
                            @endif
                        </div>
                    </div>
                <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $("#lpk").select2({
        placeholder: 'LPK',
        allowClear: true,
    });
</script>
@endsection