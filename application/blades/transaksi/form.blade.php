<div class="box-body">

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('id_kendaraan')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('id_kendaraan');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['id_kendaraan']) {
		$value = ci()->session->flashdata('old')['id_kendaraan'];
	} elseif (isset($transaksi) && $transaksi['id_kendaraan']) {
		$value = $transaksi['id_kendaraan'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="id_kendaraan" data-toggle="tooltip" title="{{$message}}">Kendaraan</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<select class="form-control select2" name="id_kendaraan">
				<option {{$value == '' ? 'selected' : null}} value="">Pilih Kendaraan</option>
				@foreach($kendaraans as $item)
				<option {{$value == $item->id ? 'selected' : null}} value="{{$item->id}}">{{$item->nomor_polisi}}</option>
				@endforeach
			</select>
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('id_loket')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('id_loket');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['id_loket']) {
		$value = ci()->session->flashdata('old')['id_loket'];
	} elseif (isset($transaksi) && $transaksi['id_loket']) {
		$value = $transaksi['id_loket'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="id_loket" data-toggle="tooltip" title="{{$message}}">Loket</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<select class="form-control select2" name="id_loket">
				<option {{$value == '' ? 'selected' : null}} value="">Pilih Loket</option>
				@foreach($lokets as $item)
				<option {{$value == $item->id ? 'selected' : null}} value="{{$item->id}}">{{$item->lokasi}}</option>
				@endforeach
			</select>
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('tanggal')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('tanggal');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['tanggal']) {
		$value = ci()->session->flashdata('old')['tanggal'];
	} elseif (isset($transaksi) && $transaksi['tanggal']) {
		$value = $transaksi['tanggal'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="tanggal" data-toggle="tooltip" title="{{$message}}">Tanggal</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="tanggal" class="form-control datepicker" placeholder="Isi Tanggal" id="tanggal" value="{{$value}}">
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('bulan')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('bulan');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['bulan']) {
		$value = ci()->session->flashdata('old')['bulan'];
	} elseif (isset($transaksi) && $transaksi['bulan']) {
		$value = $transaksi['bulan'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="bulan" data-toggle="tooltip" title="{{$message}}">Bulan</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<select class="form-control select2" name="bulan">
				<option {{$value == '' ? 'selected' : null}} value="">Pilih Bulan</option>
				@foreach(helper()->bulanIndonesia() as $key => $item)
				<option {{$value == $key ? 'selected' : null}} value="{{$key}}">{{$item}}</option>
				@endforeach
			</select>
		</div>
	</div>
	
	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('tahun')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('tahun');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['tahun']) {
		$value = ci()->session->flashdata('old')['tahun'];
	} elseif (isset($transaksi) && $transaksi['tahun']) {
		$value = $transaksi['tahun'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="tahun" data-toggle="tooltip" title="{{$message}}">Tahun</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="tahun" class="form-control" placeholder="Isi Tahun" id="tahun" value="{{$value}}">
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('outstanding')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('outstanding');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['outstanding']) {
		$value = ci()->session->flashdata('old')['outstanding'];
	} elseif (isset($transaksi) && $transaksi['outstanding']) {
		$value = $transaksi['outstanding'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="outstanding" data-toggle="tooltip" title="{{$message}}">Outstanding</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="outstanding" class="form-control mask_ribuan" placeholder="Isi Outstanding" id="outstanding" value="{{$value}}">
		</div>
	</div>
	
	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('potensi')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('potensi');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['potensi']) {
		$value = ci()->session->flashdata('old')['potensi'];
	} elseif (isset($transaksi) && $transaksi['potensi']) {
		$value = $transaksi['potensi'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="potensi" data-toggle="tooltip" title="{{$message}}">Potensi</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="potensi" class="form-control mask_ribuan" placeholder="Isi Potensi" id="potensi" value="{{$value}}">
		</div>
	</div>
	
</div>