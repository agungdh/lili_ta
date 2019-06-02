@extends('template.template')

@section('title')
Formula Tarif
@endsection

@section('nav')
@include('formulatarif.nav')
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Tambah Formula Tarif</h3>
			</div>

			<form action="{{base_url()}}formulatarif/aksitambah" method="post" role="form">
				@include('formulatarif.form')

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{base_url()}}formulatarif" class="btn btn-info">Batal</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection