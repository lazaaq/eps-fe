@extends('adminlte::auth.auth-page', ['auth_type' => 'register'])

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
<div style="margin-top:20%">
    <p style="font-size:25px; color:#263B5E;" class="text-center font-weight-bold">DAFTAR AKUN</p>
    <form action="{{ $register_url }}" method="post">
        {{ csrf_field() }}

        {{-- LPK field --}}
        {{-- <div class="input-group mb-3">
            <select name="lpk" id="lpk" class="form-control {{ $errors->has('lpk') ? 'is-invalid' : '' }}"
        placeholder="{{ __('adminlte::adminlte.lpk') }}" autofocus>
        <option></option>
        @foreach(\App\Models\Lpk::all() as $lpk)
        <option value="{{$lpk->id}}" {{(collect(old('lpk'))->contains($lpk->id)) ? 'selected':''}}>{{$lpk->name}}
        </option>
        @endforeach
        </select>
        @if($errors->has('lpk'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('lpk') }}</strong>
        </div>
        @endif
</div> --}}

{{-- Name field --}}
<div class="input-group mb-3">
    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
        value="{{ old('name') }}" placeholder="{{ __('adminlte::adminlte.full_name') }}" autofocus>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
        </div>
    </div>
    @if($errors->has('name'))
    <div class="invalid-feedback">
        <strong>{{ $errors->first('name') }}</strong>
    </div>
    @endif
</div>

{{-- Username field --}}
<div class="input-group mb-3">
    <input type="text" name="username" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}"
        value="{{ old('username') }}" placeholder="{{ __('adminlte::adminlte.username') }}" autofocus>
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-user {{ config('adminlte.classes_auth_icon', '') }}"></span>
        </div>
    </div>
    @if($errors->has('username'))
    <div class="invalid-feedback">
        <strong>{{ $errors->first('username') }}</strong>
    </div>
    @endif
</div>

<div class="input-group mb-3">
    <input type="text" name="phone" class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
        value="{{ old('phone') }}" placeholder="nomer telepon" >
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-phone {{ config('adminlte.classes_auth_icon', '') }}"></span>
        </div>
    </div>
    @if($errors->has('phone'))
    <div class="invalid-feedback">
        <strong>{{ $errors->first('phone') }}</strong>
    </div>
    @endif
</div>

{{-- Email field --}}
<div class="input-group mb-3">
    <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
        value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-envelope {{ config('adminlte.classes_auth_icon', '') }}"></span>
        </div>
    </div>
    @if($errors->has('email'))
    <div class="invalid-feedback">
        <strong>{{ $errors->first('email') }}</strong>
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

{{-- Confirm password field --}}
<div class="input-group mb-3">
    <input type="password" name="password_confirmation"
        class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
        placeholder="{{ __('adminlte::adminlte.retype_password') }}">
    <div class="input-group-append">
        <div class="input-group-text">
            <span class="fas fa-lock {{ config('adminlte.classes_auth_icon', '') }}"></span>
        </div>
    </div>
    @if($errors->has('password_confirmation'))
    <div class="invalid-feedback">
        <strong>{{ $errors->first('password_confirmation') }}</strong>
    </div>
    @endif
</div>


{{-- Register button --}}
<button style="border-radius: 29px;background-color:#039BB2" type="submit"
    class="btn btn-block {{ config('adminlte.classes_auth_btn') }}">

    {{ __('adminlte::adminlte.register') }}
</button>

</form>
</div>
@stop

@section('auth_footer')
<p style="color:#9098B1" class="my-0">
    Sudah punya akun?
    <span>
        <a style="color:#263B5E" class="font-weight-bold" href="{{ route('login') }}">
            Masuk
        </a>
    </span>
</p>
@stop

@section('js')
<script>
    $("#lpk").select2({
        placeholder: 'LPK',
        allowClear: true,
    });

</script>
@endsection
