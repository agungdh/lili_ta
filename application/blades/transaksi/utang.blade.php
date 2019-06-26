<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Kendaraan Belum Bayar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover" style="width: 100%" border="1">
                <thead>
	                <tr>   
                        <th>No Polisi</th>
                        <th>Formula Tarif</th>
                        <th>Seat</th>
                        <th>Count</th>
	                </tr>
                </thead>
                <tbody>
                	@foreach($kendaraans as $item)
                	<tr>
                        <td>{{$item->nomor_polisi}}</td>
                        <td>{{helper()->rupiah($item->formulaTarif->tarif)}}</td>
                        <td>{{$item->seat_aktif}}/{{$item->jumlah_seat}}</td>
                        <td>{{$hutangKendaraans[$item->id]}} Bulan</td>
                	</tr>
                        @php
                        $detailKendaraan = helper()->detilBulanTahunKendaraanBelumBayar($item->id);
                        @endphp
                        @if($detailKendaraan)
                            @foreach($detailKendaraan['bulanTahunBelumBayar'] as $item2)
                            <tr>
                                <td colspan="4" style="text-align: right;">{{$item2[0]}}/{{$item2[1]}} </td>
                            </tr>
                        	@endforeach
                        @endif
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
	</div>
</div>