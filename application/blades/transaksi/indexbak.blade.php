@extends('template.template')

@section('title')
Transaksi
@endsection

@section('nav')
@include('transaksi.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Transaksi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            	<a class="btn btn-success btn-sm" href="{{base_url()}}transaksi/tambah">
                  <i class="glyphicon glyphicon-plus"></i> Tambah
                </a><br><br>
              <table class="table table-bordered table-hover datatable" style="width: 100%">
                <thead>
	                <tr>
                    <th>Nomor Polisi</th>
                    <th>Pemilik Kendaraan</th>
                    <th>Formula Tarif</th>
                    <th>Seat</th>
                    <th>Tanggal</th>
                    <th>Loket</th>
                    <th>Outstanding</th>
                    <th>Potensi</th>
	                  <th>Proses</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach($transaksis as $item)
                	<tr>
                    <td>{{$item->kendaraan->nomor_polisi}}</td>
                    <td>{{$item->kendaraan->pemilikKendaraan->nama}}</td>
                    <td>{{helper()->rupiah($item->kendaraan->formulaTarif->tarif)}}</td>
                    <td>{{$item->kendaraan->seat_aktif}}/{{$item->kendaraan->jumlah_seat}}</td>
                    <td>{{helper()->tanggalIndo($item->tanggal)}}</td>
                    <td>{{$item->loket->lokasi}}</td>
                    <td>{{helper()->rupiah($item->outstanding)}}</td>
                    <td>{{helper()->rupiah($item->potensi)}}</td>
                		
                		<td>
                      <a class="btn btn-primary btn-sm" href="{{base_url()}}transaksi/ubah/{{$item->id}}">
    	                  <i class="glyphicon glyphicon-pencil"></i> Ubah
    	                </a>

	                 		<button type="button" class="btn btn-danger btn-sm" onclick="hapus('{{ $item->id }}')"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
                		</td>
                	</tr>
                	@endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
	</div>
</div>
@endsection

@section('js')
<script type="text/javascript">
function hapus(id) {
	swal({
	  title: "Yakin Hapus ???",
	  text: "Data yang sudah dihapus tidak dapat dikembalikan lagi !!!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Hapus",
	}, function(){
	  window.location = "{{base_url()}}transaksi/aksihapus/" + id;
	});
}
</script>
@endsection