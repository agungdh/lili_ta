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
	} elseif (isset($pemilikkendaraan) && $pemilikkendaraan['kode']) {
		$value = $pemilikkendaraan['kode'];
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
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('nama')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('nama');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['nama']) {
		$value = ci()->session->flashdata('old')['nama'];
	} elseif (isset($pemilikkendaraan) && $pemilikkendaraan['nama']) {
		$value = $pemilikkendaraan['nama'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="nama" data-toggle="tooltip" title="{{$message}}">Nama</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="nama" class="form-control" placeholder="Isi Nama" id="nama" value="{{$value}}">
		</div>
	</div>
	
</div>