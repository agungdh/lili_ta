@extends('template.template')

@section('title')
Log
@endsection

@section('nav')
<li><a href="{{ base_url() }}log"><i class="fa fa-home"></i> Log</a></li>
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Log</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover datatable" style="width: 100%">
                <thead>
                  <tr>
                      <th>Waktu</th>
                      <th>Pemilik Kendaraan</th>
                      <th>No HP</th>
                      <th>Pesan</th>
                      <th>Respon</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($logs as $item)
                  <tr>
                        <td>{{helper()->tanggalWaktuIndo($item->datetime)}}</td>
                        <td>{{$item->pemilikKendaraan->id}} - {{$item->pemilikKendaraan->nama}}</td>
                        <td>{{$item->pemilikKendaraan->nohp}}</td>
                        <td>{{$item->req_text}}</td>
                        <td>{{$item->res_status}}: {{$item->res_text}}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  </div>
</div>
@endsection