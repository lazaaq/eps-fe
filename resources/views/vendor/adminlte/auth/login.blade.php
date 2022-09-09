@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@stop

@php( $login_url = View::getSection('login_url') ?? config('adminlte.login_url', 'login') )
@php( $register_url = View::getSection('register_url') ?? config('adminlte.register_url', 'register') )

@if (config('adminlte.use_route_url', false))
@php( $login_url = $login_url ? route($login_url) : '' )
@php( $register_url = $register_url ? route($register_url) : '' )
@else
@php( $login_url = $login_url ? url($login_url) : '' )
@php( $register_url = $register_url ? url($register_url) : '' )
@endif




@section('auth_body')
    <div style="margin-top: 50%">
        <p style="font-size:25px;color:#263B5E" class="text-center font-weight-bold">MASUK</p>
    <form action="{{ $login_url }}" method="post">
        {{ csrf_field() }}

        {{-- Email field --}}
        <div class="input-group mb-3">
            <input type="username" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
                   value="{{ old('username') }}" placeholder="{{ __('adminlte::adminlte.username') }}" autofocus>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('username'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('username') }}</strong>
                </div>
            @endif
        </div>

        {{-- Password field --}}
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                   placeholder="{{ __('adminlte::adminlte.password') }}">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
                </div>
            </div>
            @if($errors->has('password'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('password') }}</strong>
                </div>
            @endif
        </div>

        {{-- Login field --}}
        <div class="row">
            <div class="col-7">
                <div class="icheck-primary">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">{{ __('adminlte::adminlte.remember_me') }}</label>
                </div>
            </div>
            <div class="col-12">
                <button style="border-radius: 29px;background-color:#039BB2" type=submit class="btn btn-block {{ config('adminlte.classes_auth_btn') }}">
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>

    </form>
    
    </div>
@stop
@section('auth_footer')
<p style="color:#9098B1"class="my-0">
     Belum punya akun? 
     <span>
    <a style="color:#263B5E" class="font-weight-bold" href="{{ route('register') }}">
        Daftar
    </a>
    </span>
</p>
@stop


