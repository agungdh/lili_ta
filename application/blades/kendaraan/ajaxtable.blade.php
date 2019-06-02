<table class="table table-bordered table-hover" style="width: 100%" id="datatable">
  <thead>
    <tr>
      <th>No Polisi</th>
      <th>Pemilik Kendaraan</th>
      <th>Tarif</th>
      <th>Seat</th>
      <th>Proses</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($kendaraans as $item)
  	<tr>
  		<td>{{$item->nomor_polisi}}</td>
      <td>{{$item->pemilikKendaraan->nama}}</td>
      <td>{{helper()->rupiah($item->formulaTarif->tarif)}}</td>
      <td>{{$item->seat_aktif}}/{{$item->jumlah_seat}}</td>
  		
  		<td>
        <a class="btn btn-primary btn-sm" href="{{base_url()}}kendaraan/ubah/{{$item->id}}">
          <i class="glyphicon glyphicon-pencil"></i> Ubah
        </a>

     		<button type="button" class="btn btn-danger btn-sm" onclick="hapus('{{ $item->id }}')"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
  		</td>
  	</tr>
  	@endforeach
  </tbody>
</table>

<script type="text/javascript">
  var a = $('#datatable').DataTable({
    responsive: false,
    "scrollX": true
  });
</script>