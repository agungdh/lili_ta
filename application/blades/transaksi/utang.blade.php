<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Kendaraan Belum Bayar</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table class="table table-bordered table-hover" style="width: 100%">
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
                    @php
                    $detailKendaraan = helper()->detilBulanTahunKendaraanBelumBayar($item->id);
                    @endphp
                    @if(count($detailKendaraan['bulanTahunBelumBayar']) > 0)
                	<tr>
                        <td><b>{{$item->nomor_polisi}}</b></td>
                        <td>{{helper()->rupiah($item->formulaTarif->tarif)}}</td>
                        <td>{{$item->seat_aktif}}/{{$item->jumlah_seat}}</td>
                        <td>{{count($detailKendaraan['bulanTahunBelumBayar'])}} Bulan</td>
                	</tr>
                    <tr>
                        <td><u>
                        @foreach($detailKendaraan['bulanTahunBelumBayar'] as $item2)
                            {{$item2[0]}}/{{$item2[1]}}, 
                    	@endforeach
                        </u></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
	</div>
</div>