<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h3 style="text-align: center;">Laporan Bulanan Transaksi PT Jasa Raharja</h3>
<h3 style="text-align: center;">{{helper()->tanggalIndoStringBulanTahun("{$bulan}-{$tahun}")}}</h3>
<table border="1" width="100%">
	<thead>
		<tr>
			<th>NO</th>
			<th>Nomor Polisi</th>
			<th>Jenis Angkutan</th>
			<th>Pemilik Kendaraan</th>
			<th>Formula Tarif</th>
			<th>Seat</th>
			<th>Tanggal</th>
			<th>Bulan/Tahun</th>
		</tr>
	</thead>
	<tbody>
		@php
		$i = 1;
		@endphp
		@foreach($transaksis as $item)
		<tr>
			<td>{{$i++}}</td>
			<td>{{$item->kendaraan->nomor_polisi}}</td>
		      <td>{{$item->kendaraan->formulaTarif->jenis_angkutan}}</td>
		      <td>{{$item->kendaraan->pemilikKendaraan->nama}}</td>
		      <td>{{helper()->rupiah($item->kendaraan->formulaTarif->tarif)}}</td>
		      <td>{{$item->kendaraan->seat_aktif}}/{{$item->kendaraan->jumlah_seat}}</td>
		      <td>{{helper()->tanggalIndo($item->tanggal)}}</td>
		      <td>{{$item->bulan}}/{{$item->tahun}}</td>
		</tr>
		@endforeach
	</tbody>
</table>

</body>
</html>