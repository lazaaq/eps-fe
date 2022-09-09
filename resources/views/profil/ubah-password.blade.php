@extends('adminlte::page')

<!-- @section('title', 'RUKO') -->

@section('content_header')
<h1 class="m-0 text-dark">{{ __('Profil') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
                <form action="{{route('profil.updatePassword')}}" method="post">
                @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kata Sandi Sekarang</label>
                            <input type="password" class="form-control" name="kata_sandi_sekarang">
                            @if($errors->has('kata_sandi_sekarang'))
                                <div class="">
                                    <strong class="text-danger">{{ $errors->first('kata_sandi_sekarang') }}</strong>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="">
                                    <strong class="text-danger">{{ session('error') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kata Sandi Baru</label>
                            <input type="password" class="form-control" name="kata_sandi_baru">
                            @if($errors->has('kata_sandi_baru'))
                                <div class="">
                                    <strong class="text-danger">{{ $errors->first('kata_sandi_baru') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Konfirmasi Sandi Baru</label>
                            <input type="password" class="form-control" name="kata_sandi_baru_confirmation">
                            @if($errors->has('kata_sandi_baru_confirmation'))
                                <div class="">
                                    <strong class="text-danger">{{ $errors->first('kata_sandi_baru_confirmation') }}</strong>
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