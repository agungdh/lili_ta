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
			<div class="box-header with-border">
				<h3 class="box-title">Ubah Transaksi</h3>
			</div>

			<form action="{{base_url()}}transaksi/aksiubah/{{$transaksi->id}}" method="post" role="form">
				@include('transaksi.form')

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{base_url()}}transaksi" class="btn btn-info">Batal</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection