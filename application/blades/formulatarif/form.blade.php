<div class="box-body">

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('jenis_angkutan')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('jenis_angkutan');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['jenis_angkutan']) {
		$value = ci()->session->flashdata('old')['jenis_angkutan'];
	} elseif (isset($formulatarif) && $formulatarif['jenis_angkutan']) {
		$value = $formulatarif['jenis_angkutan'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="jenis_angkutan" data-toggle="tooltip" title="{{$message}}">Jenis Angkutan</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="jenis_angkutan" class="form-control" placeholder="Isi Jenis Angkutan" id="jenis_angkutan" value="{{$value}}">
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('jumlah_seat_sampai_dengan')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('jumlah_seat_sampai_dengan');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['jumlah_seat_sampai_dengan']) {
		$value = ci()->session->flashdata('old')['jumlah_seat_sampai_dengan'];
	} elseif (isset($formulatarif) && $formulatarif['jumlah_seat_sampai_dengan']) {
		$value = $formulatarif['jumlah_seat_sampai_dengan'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="jumlah_seat_sampai_dengan" data-toggle="tooltip" title="{{$message}}">Jumlah Seat Sampai Dengan</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="jumlah_seat_sampai_dengan" class="form-control mask_ribuan" placeholder="Isi Jumlah Seat Sampai Dengan" id="jumlah_seat_sampai_dengan" value="{{$value}}">
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

@section('js')
<script type="text/javascript">
$("#jenis_angkutan").easyAutocomplete({
  url: function(phrase) {
    return "{{base_url()}}formulatarif/getJenisAngkutan/" + phrase;
  },
  getValue: "name",
  requestDelay: 200
});
</script>
@endsection