@extends('adminlte::page')

<!-- @section('title', 'RUKO') -->

@section('content_header')
<h1 class="m-0 text-dark">{{ __('adminlte::menu.keranjang') }}</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="mb-3"><strong>Pembelian paket secara satuan akan dikumpulkan kedalam keranjang sebelum diproses ke tahap pembayaran</strong></div>
                <hr>
                <div id="component-keranjang">
                    @include('keranjang.component')
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('js')
<script src="{{asset('js/cart.js')}}"></script>
<script>

$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      alert( "Form successful submitted!" );
    }
  });
  $('#quickForm').validate({
    rules: {
      metode_bayar: {
        required: true,
      },
    },
    messages: {
      metode_bayar: {
        required: "Metode bayar harus dipilih.",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>
@endsection
