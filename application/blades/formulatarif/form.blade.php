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
	} elseif (isset($formulatarif) && $formulatarif['kode']) {
		$value = $formulatarif['kode'];
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
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('tarif')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('tarif');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['tarif']) {
		$value = ci()->session->flashdata('old')['tarif'];
	} elseif (isset($formulatarif) && $formulatarif['tarif']) {
		$value = $formulatarif['tarif'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="tarif" data-toggle="tooltip" title="{{$message}}">Tarif</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="tarif" class="form-control mask_ribuan" placeholder="Isi Tarif" id="tarif" value="{{$value}}">
		</div>
	</div>
	
</div>