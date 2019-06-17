<div class="box-body">

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
	} elseif (isset($loket) && $loket['lokasi']) {
		$value = $loket['lokasi'];
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