@extends('template.template')

@section('title')
Konfigurasi
@endsection

@section('nav')
<li><a href="{{ base_url() }}konfigurasi"><i class="fa fa-home"></i> Konfigurasi</a></li>
@endsection

@section('content')
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header with-border">
				<h3 class="box-title">Konfigurasi</h3>
			</div>

			<form action="{{base_url()}}konfigurasi/ubah" method="post" role="form">
				
				<div class="box-body">

					@php
					if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('APP_TITLE')) {
						$class = 'form-group has-feedback has-error';
						$message = ci()->session->flashdata('errors')->first('APP_TITLE');
					} else {
						$class = 'form-group has-feedback';
						$message = '';
					}

					if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['APP_TITLE']) {
						$value = ci()->session->flashdata('old')['APP_TITLE'];
					} elseif (isset($konfigurasi) && $konfigurasi['APP_TITLE']) {
						$value = $konfigurasi['APP_TITLE'];
					} else {
						$value = '';
					}
					@endphp
					<div class="{{$class}}">
						<label for="APP_TITLE" data-toggle="tooltip" title="{{$message}}">APP_TITLE</label>
						<div data-toggle="tooltip" title="{{$message}}">
							<input type="text" name="APP_TITLE" class="form-control" placeholder="Isi APP_TITLE" id="APP_TITLE" value="{{$value}}">
						</div>
					</div>
					
					@php
					if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('APP_TITLE_SHORT')) {
						$class = 'form-group has-feedback has-error';
						$message = ci()->session->flashdata('errors')->first('APP_TITLE_SHORT');
					} else {
						$class = 'form-group has-feedback';
						$message = '';
					}

					if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['APP_TITLE_SHORT']) {
						$value = ci()->session->flashdata('old')['APP_TITLE_SHORT'];
					} elseif (isset($konfigurasi) && $konfigurasi['APP_TITLE_SHORT']) {
						$value = $konfigurasi['APP_TITLE_SHORT'];
					} else {
						$value = '';
					}
					@endphp
					<div class="{{$class}}">
						<label for="APP_TITLE_SHORT" data-toggle="tooltip" title="{{$message}}">APP_TITLE_SHORT</label>
						<div data-toggle="tooltip" title="{{$message}}">
							<input type="text" name="APP_TITLE_SHORT" class="form-control" placeholder="Isi APP_TITLE_SHORT" id="APP_TITLE_SHORT" value="{{$value}}">
						</div>
					</div>
					
					@php
					if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('APP_TITLE_SHORTER')) {
						$class = 'form-group has-feedback has-error';
						$message = ci()->session->flashdata('errors')->first('APP_TITLE_SHORTER');
					} else {
						$class = 'form-group has-feedback';
						$message = '';
					}

					if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['APP_TITLE_SHORTER']) {
						$value = ci()->session->flashdata('old')['APP_TITLE_SHORTER'];
					} elseif (isset($konfigurasi) && $konfigurasi['APP_TITLE_SHORTER']) {
						$value = $konfigurasi['APP_TITLE_SHORTER'];
					} else {
						$value = '';
					}
					@endphp
					<div class="{{$class}}">
						<label for="APP_TITLE_SHORTER" data-toggle="tooltip" title="{{$message}}">APP_TITLE_SHORTER</label>
						<div data-toggle="tooltip" title="{{$message}}">
							<input type="text" name="APP_TITLE_SHORTER" class="form-control" placeholder="Isi APP_TITLE_SHORTER" id="APP_TITLE_SHORTER" value="{{$value}}">
						</div>
					</div>
					
					@php
					if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('ZENZIVA_API_USER')) {
						$class = 'form-group has-feedback has-error';
						$message = ci()->session->flashdata('errors')->first('ZENZIVA_API_USER');
					} else {
						$class = 'form-group has-feedback';
						$message = '';
					}

					if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['ZENZIVA_API_USER']) {
						$value = ci()->session->flashdata('old')['ZENZIVA_API_USER'];
					} elseif (isset($konfigurasi) && $konfigurasi['ZENZIVA_API_USER']) {
						$value = $konfigurasi['ZENZIVA_API_USER'];
					} else {
						$value = '';
					}
					@endphp
					<div class="{{$class}}">
						<label for="ZENZIVA_API_USER" data-toggle="tooltip" title="{{$message}}">ZENZIVA_API_USER</label>
						<div data-toggle="tooltip" title="{{$message}}">
							<input type="text" name="ZENZIVA_API_USER" class="form-control" placeholder="Isi ZENZIVA_API_USER" id="ZENZIVA_API_USER" value="{{$value}}">
						</div>
					</div>
					
					@php
					if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('ZENZIVA_API_PASS')) {
						$class = 'form-group has-feedback has-error';
						$message = ci()->session->flashdata('errors')->first('ZENZIVA_API_PASS');
					} else {
						$class = 'form-group has-feedback';
						$message = '';
					}

					if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['ZENZIVA_API_PASS']) {
						$value = ci()->session->flashdata('old')['ZENZIVA_API_PASS'];
					} elseif (isset($konfigurasi) && $konfigurasi['ZENZIVA_API_PASS']) {
						$value = $konfigurasi['ZENZIVA_API_PASS'];
					} else {
						$value = '';
					}
					@endphp
					<div class="{{$class}}">
						<label for="ZENZIVA_API_PASS" data-toggle="tooltip" title="{{$message}}">ZENZIVA_API_PASS</label>
						<div data-toggle="tooltip" title="{{$message}}">
							<input type="text" name="ZENZIVA_API_PASS" class="form-control" placeholder="Isi ZENZIVA_API_PASS" id="ZENZIVA_API_PASS" value="{{$value}}">
						</div>
					</div>
					
					@php
					if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN')) {
						$class = 'form-group has-feedback has-error';
						$message = ci()->session->flashdata('errors')->first('DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN');
					} else {
						$class = 'form-group has-feedback';
						$message = '';
					}

					if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN']) {
						$value = ci()->session->flashdata('old')['DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN'];
					} elseif (isset($konfigurasi) && $konfigurasi['DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN']) {
						$value = $konfigurasi['DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN'];
					} else {
						$value = '';
					}
					@endphp
					<div class="{{$class}}">
						<label for="DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN" data-toggle="tooltip" title="{{$message}}">DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN</label>
						<div data-toggle="tooltip" title="{{$message}}">
							<input type="text" name="DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN" class="form-control" placeholder="Isi DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN" id="DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN" value="{{$value}}">
						</div>
					</div>
					
					@php
					if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN')) {
						$class = 'form-group has-feedback has-error';
						$message = ci()->session->flashdata('errors')->first('DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN');
					} else {
						$class = 'form-group has-feedback';
						$message = '';
					}

					if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN']) {
						$value = ci()->session->flashdata('old')['DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN'];
					} elseif (isset($konfigurasi) && $konfigurasi['DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN']) {
						$value = $konfigurasi['DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN'];
					} else {
						$value = '';
					}
					@endphp
					<div class="{{$class}}">
						<label for="DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN" data-toggle="tooltip" title="{{$message}}">DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN</label>
						<div data-toggle="tooltip" title="{{$message}}">
							<input type="text" name="DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN" class="form-control" placeholder="Isi DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN" id="DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN" value="{{$value}}">
						</div>
					</div>
					
				</div>

				<div class="box-footer">
					<button type="submit" class="btn btn-success">Simpan</button>
					<a href="{{base_url()}}konfigurasi" class="btn btn-info">Batal</a>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection