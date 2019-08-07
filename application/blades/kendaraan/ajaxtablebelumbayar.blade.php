<p>Jumlah Kendaraan Belum Bayar: {{$jumlahBelumBayar['jumlah']}}</p>
<p>Jumlah Bulan Belum Bayar: {{$jumlahBelumBayar['total']}}</p>
<p>Jumlah Biaya Belum Bayar: {{helper()->rupiah($jumlahBelumBayar['biaya'])}}</p>
<table class="table table-bordered table-hover" style="width: 100%" id="datatableb">
  <thead>
    <tr>
      <th>No Polisi</th>
      <th>Jenis Angkutan</th>
      <th>Pemilik Kendaraan</th>
      <th>Tarif</th>
      <th>Seat</th>
      <th>Bulan Tahun</th>
    </tr>
  </thead>
  <tbody>
  	@foreach($jumlahBelumBayar['kendaraan'] as $itemRaw)
      @foreach($itemRaw['detilBulanBelumBayar'] as $item)
    	<tr>
    		<td>{{$itemRaw['instance']->nomor_polisi}}</td>
        <td>{{$itemRaw['instance']->formulaTarif->jenis_angkutan}}</td>
        <td>{{$itemRaw['instance']->pemilikKendaraan->nama}}</td>
        <td>{{helper()->rupiah($itemRaw['instance']->formulaTarif->tarif)}}</td>
        <td>{{$itemRaw['instance']->seat_aktif}}/{{$itemRaw['instance']->jumlah_seat}}</td>
        <td>{{$item[0] . '-' . $item[1]}}</td>
    	</tr>
  	 @endforeach
    @endforeach
  </tbody>
</table>

<script type="text/javascript">
  var b = $('#datatableb').DataTable({
    responsive: false,
    "scrollX": true
  });
</script>