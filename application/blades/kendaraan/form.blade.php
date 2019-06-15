@php
$config = helper()->getKonfigurasi();
@endphp

<div class="box-body">

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('id_pemilik_kendaraan')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('id_pemilik_kendaraan');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['id_pemilik_kendaraan']) {
		$value = ci()->session->flashdata('old')['id_pemilik_kendaraan'];
	} elseif (isset($kendaraan) && $kendaraan['id_pemilik_kendaraan']) {
		$value = $kendaraan['id_pemilik_kendaraan'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="id_pemilik_kendaraan" data-toggle="tooltip" title="{{$message}}">Pemilik Kendaraan</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<select class="form-control select2" name="id_pemilik_kendaraan">
				<option {{$value == '' ? 'selected' : null}} value="">Pilih Pemilik Kendaraan</option>
				@foreach($pemilikKendaraans as $item)
				<option {{$value == $item->id ? 'selected' : null}} value="{{$item->id}}">{{$item->nama}}</option>
				@endforeach
			</select>
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('id_formula_tarif')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('id_formula_tarif');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['id_formula_tarif']) {
		$value = ci()->session->flashdata('old')['id_formula_tarif'];
	} elseif (isset($kendaraan) && $kendaraan['id_formula_tarif']) {
		$value = $kendaraan['id_formula_tarif'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="id_formula_tarif" data-toggle="tooltip" title="{{$message}}">Formula Tarif</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<select class="form-control select2" name="id_formula_tarif">
				<option {{$value == '' ? 'selected' : null}} value="">Pilih Formula Tarif</option>
				@foreach($formulaTarifs as $item)
				<option {{$value == $item->id ? 'selected' : null}} value="{{$item->id}}">{{helper()->rupiah($item->tarif)}}</option>
				@endforeach
			</select>
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('nomor_polisi')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('nomor_polisi');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['nomor_polisi']) {
		$value = ci()->session->flashdata('old')['nomor_polisi'];
	} elseif (isset($kendaraan) && $kendaraan['nomor_polisi']) {
		$value = $kendaraan['nomor_polisi'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="nomor_polisi" data-toggle="tooltip" title="{{$message}}">Nomor Polisi</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="nomor_polisi" class="form-control" placeholder="Isi Nomor Polisi" id="nomor_polisi" value="{{$value}}">
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('seat_aktif')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('seat_aktif');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['seat_aktif']) {
		$value = ci()->session->flashdata('old')['seat_aktif'];
	} elseif (isset($kendaraan) && $kendaraan['seat_aktif']) {
		$value = $kendaraan['seat_aktif'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="seat_aktif" data-toggle="tooltip" title="{{$message}}">Seat Aktif</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="seat_aktif" class="form-control" placeholder="Isi Seat Aktif" id="seat_aktif" value="{{$value}}">
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('jumlah_seat')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('jumlah_seat');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['jumlah_seat']) {
		$value = ci()->session->flashdata('old')['jumlah_seat'];
	} elseif (isset($kendaraan) && $kendaraan['jumlah_seat']) {
		$value = $kendaraan['jumlah_seat'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="jumlah_seat" data-toggle="tooltip" title="{{$message}}">Jumlah Seat</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="jumlah_seat" class="form-control" placeholder="Isi Jumlah Seat" id="jumlah_seat" value="{{$value}}">
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('mulai_penagihan_bulan')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('mulai_penagihan_bulan');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['mulai_penagihan_bulan']) {
		$value = ci()->session->flashdata('old')['mulai_penagihan_bulan'];
	} elseif (isset($kendaraan) && $kendaraan['mulai_penagihan_bulan']) {
		$value = $kendaraan['mulai_penagihan_bulan'];
	} else {
		$value = $config['DEFAULT_KENDARAAN_MULAI_PENAGIHAN_BULAN'];
	}
	@endphp
	<div class="{{$class}}">
		<label for="mulai_penagihan_bulan" data-toggle="tooltip" title="{{$message}}">Mulai Penagihan Bulan</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="mulai_penagihan_bulan" class="form-control" placeholder="Isi Mulai Penagihan Bulan" id="mulai_penagihan_bulan" value="{{$value}}">
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('mulai_penagihan_tahun')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('mulai_penagihan_tahun');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['mulai_penagihan_tahun']) {
		$value = ci()->session->flashdata('old')['mulai_penagihan_tahun'];
	} elseif (isset($kendaraan) && $kendaraan['mulai_penagihan_tahun']) {
		$value = $kendaraan['mulai_penagihan_tahun'];
	} else {
		$value = $config['DEFAULT_KENDARAAN_MULAI_PENAGIHAN_TAHUN'];
	}
	@endphp
	<div class="{{$class}}">
		<label for="mulai_penagihan_tahun" data-toggle="tooltip" title="{{$message}}">Mulai Penagihan Tahun</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="mulai_penagihan_tahun" class="form-control" placeholder="Isi Mulai Penagihan Tahun" id="mulai_penagihan_tahun" value="{{$value}}">
		</div>
	</div>
	
</div>