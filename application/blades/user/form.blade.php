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
	} elseif (isset($user) && $user['nik']) {
		$value = $user['nik'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="nik" data-toggle="tooltip" title="{{$message}}">Karyawan</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<select class="form-control select2" name="nik">
				<option {{$value == '' ? 'selected' : null}} value="">Pilih Karyawan</option>
				@foreach($karyawans as $item)
				<option {{$value == $item->nik ? 'selected' : null}} value="{{$item->nik}}">{{$item->nik}} - {{$item->nama}} - {{$item->jabatan}}</option>
				@endforeach
			</select>
		</div>
	</div>
	
	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('level')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('level');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}

	if (ci()->session->flashdata('old') && ci()->session->flashdata('old')['level']) {
		$value = ci()->session->flashdata('old')['level'];
	} elseif (isset($user) && $user['level']) {
		$value = $user['level'];
	} else {
		$value = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="level" data-toggle="tooltip" title="{{$message}}">Level</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<select class="form-control select2" name="level">
				<option {{$value == '' ? 'selected' : null}} value="">Pilih Level</option>
				<option {{$value == 'b' ? 'selected' : null}} value="b">Boss</option>
				<option {{$value == 'o' ? 'selected' : null}} value="o">Operator</option>
			</select>
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('password')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('password');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="password" data-toggle="tooltip" title="{{$message}}">Password</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="password" name="password" class="form-control" placeholder="Isi Password" id="password">
		</div>
	</div>

	@php
	if (ci()->session->flashdata('errors') && ci()->session->flashdata('errors')->has('password')) {
		$class = 'form-group has-feedback has-error';
		$message = ci()->session->flashdata('errors')->first('password');
	} else {
		$class = 'form-group has-feedback';
		$message = '';
	}
	@endphp
	<div class="{{$class}}">
		<label for="password_confirmation" data-toggle="tooltip" title="{{$message}}">Ulangi Password</label>
		<div data-toggle="tooltip" title="{{$message}}">
			<input type="password" name="password_confirmation" class="form-control" placeholder="Isi Ulangi Password" id="password_confirmation">
		</div>
	</div>
	
</div>