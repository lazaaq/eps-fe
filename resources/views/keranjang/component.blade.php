@if($data->isEmpty())
<div class="container-fluid mt-4 d-flex justify-content-center w-100">
    <h5 class="font-weight-bold">Keranjang Anda masih kosong.</h5>
</div>
@else

<div class="card shadow-none">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap table-striped">
            <thead class="bg-lightblue">
                <tr>
                    <th width="30">#</th>
                    <th>Topik</th>
                    <th>Paket</th>
                    <th class="text-right">Harga</th>
                    <th width="100" class="text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $key => $item)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$item->detailPaket->paket->topik->name}}</td>
                    <td>{{$item->detailPaket->paket->name}}</td>
                    <td class="text-right" data-price="{{$item->price}}">{{'Rp '.number_format($item->price,0,".",".")}}</td>
                    <td class="text-right"><button class="btn btn-danger btn-sm btn-delete-paket" data-paket="{{$item->package_id}}"><i class="fas fa-fw fa-trash"></i></button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <hr class="my-4">
    <div class="d-flex flex-md-row justify-content-end align-items-stretch">
        <h4 class="text-right">
            <small>Total :</small>
            <strong id="total-harga">{{'Rp '.number_format($data->sum('price'),0,".",".")}}</strong>
        </h4>
    </div>
</div>
<button type="button" class="btn bg-lightblue float-right" data-toggle="modal" data-target="#modal-default">
    <i class="fas fa-fw fa-shopping-cart mr-1"></i>Proses Pembayaran
</button>
<!-- <hr> -->

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
            <form class="" id="quickForm" action="{{route('transaksi.store')}}" method="post">
            @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Pilih Metode Bayar</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($errors->has('metode_bayar'))
                        <label style="padding-top:7px;color:#F44336;">
                            <strong><i class="fa fa-times-circle"></i> {{ $errors->first('metode_bayar') }}</strong>
                        </label>
                    @endif
                    @foreach (\App\Models\Komponen::where('code_group','PAYMENT_METHOD')->get() as $key => $item)
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input" type="radio" id="customRadio_{{$key}}" name="metode_bayar" value="{{$item->com_cd}}" required>
                        <label for="customRadio_{{$key}}" class="custom-control-label">
                        <?php $url = \config('apiurl.url').'/img/logo-bank/'.$item->note2; ?>
                        <img src="{{$url}}" alt="{{$item->code_nm}}" class="img-fluid mb-2" style="height:50px">
                        </label>
                    </div>
                    <hr>
                    @endforeach
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Proses Pembayaran</button>
                </div>
			</form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endif
