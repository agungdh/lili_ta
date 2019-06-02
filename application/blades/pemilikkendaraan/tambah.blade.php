@extends('template.template')

@section('title')
Pemilik Kendaraan
@endsection

@section('nav')
@include('pemilikkendaraan.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Pemilik Kendaraan</h3>
			</div>

			<form action="{{base_url()}}pemilikkendaraan/aksitambah" method="post" role="form">
				@include('pemilikkendaraan.form')

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{base_url()}}pemilikkendaraan" class="btn btn-info">Batal</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection