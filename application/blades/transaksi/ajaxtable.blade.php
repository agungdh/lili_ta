<table class="table table-bordered table-hover" style="width: 100%" id="datatable">
  <thead>
    <tr>
      <th>Nomor Polisi</th>
      <th>Pemilik Kendaraan</th>
      <th>Formula Tarif</th>
      <th>Seat</th>
      <th>Tanggal</th>
      <th>Bulan/Tahun</th>
      @if(getUserData()->level == 'o')
      <th>Proses</th>
      @endif
    </tr>
  </thead>
  <tbody>
    @foreach($transaksis as $item)
    <tr>
      <td>{{$item->kendaraan->nomor_polisi}}</td>
      <td>{{$item->kendaraan->pemilikKendaraan->nama}}</td>
      <td>{{helper()->rupiah($item->kendaraan->formulaTarif->tarif)}}</td>
      <td>{{$item->kendaraan->seat_aktif}}/{{$item->kendaraan->jumlah_seat}}</td>
      <td>{{helper()->tanggalIndo($item->tanggal)}}</td>
      <td>{{$item->bulan}}/{{$item->tahun}}</td>
      
      @if(getUserData()->level == 'o')
      <td>
        <a class="btn btn-primary btn-sm" href="{{base_url()}}transaksi/ubah/{{$item->id}}">
          <i class="glyphicon glyphicon-pencil"></i> Ubah
        </a>

        <button type="button" class="btn btn-danger btn-sm" onclick="hapus('{{ $item->id }}')"><i class="glyphicon glyphicon-trash"></i> Hapus</button>
      </td>
      @endif
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