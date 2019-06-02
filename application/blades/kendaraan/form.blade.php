<div class="box-body">

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('kode')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('kode');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['kode']) {
		$value = ci()->session->flashdata('old')['kode'];
	} elseif (isset($kendaraan) && $kendaraan['kode']) {
		$value = $kendaraan['kode'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="kode" data-toggle="tooltip" title="{{$message}}">Kode</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="kode" class="form-control" placeholder="Isi Kode" id="kode" value="{{$value}}">
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('lokasi')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('lokasi');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['lokasi']) {
		$value = ci()->session->flashdata('old')['lokasi'];
	} elseif (isset($kendaraan) && $kendaraan['lokasi']) {
		$value = $kendaraan['lokasi'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="lokasi" data-toggle="tooltip" title="{{$message}}">Lokasi</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="lokasi" class="form-control" placeholder="Isi Lokasi" id="lokasi" value="{{$value}}">
		</div>
	</div>
	
</div>