<div class="box-body">

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('nik')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('nik');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['nik']) {
		$value = ci()->session->flashdata('old')['nik'];
	} elseif (isset($karyawan) && $karyawan['nik']) {
		$value = $karyawan['nik'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="nik" data-toggle="tooltip" title="{{$message}}">NIK</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="nik" class="form-control" placeholder="Isi NIK" id="nik" value="{{$value}}">
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
	} elseif (isset($karyawan) && $karyawan['nama']) {
		$value = $karyawan['nama'];
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

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('jabatan')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('jabatan');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['jabatan']) {
		$value = ci()->session->flashdata('old')['jabatan'];
	} elseif (isset($karyawan) && $karyawan['jabatan']) {
		$value = $karyawan['jabatan'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="jabatan" data-toggle="tooltip" title="{{$message}}">Jabatan</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="text" name="jabatan" class="form-control" placeholder="Isi Jabatan" id="jabatan" value="{{$value}}">
		</div>
	</div>
	
</div>

@section('js')
<script type="text/javascript">
$("#jabatan").easyAutocomplete({
  url: function(phrase) {
    return "{{base_url()}}karyawan/getJabatan/" + phrase;
  },
  getValue: "name",
  requestDelay: 200
});
</script>
@endsection