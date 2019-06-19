@extends('template.template')

@section('title')
Dashboard
@endsection

@section('nav')
@include('dashboard.nav')
@endsection

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="box box-primary">
      <div class="box-header">
        <h3 class="box-title">Grafik Kendaraan Belum Bayar</h3>
      </div>
      <div class="box-body">
        <div class="embed-responsive embed-responsive-16by9">
          <canvas class="embed-responsive-item" id="chartBelumBayar"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
var data = {
      labels: [
      
      @php
      for ($i=0; $i <= 11; $i++) {
            $array[] = helper()->tanggalIndoStringBulanTahun(date("m-Y", strtotime("-" . $i - 1 . " months")));
      }
      foreach (array_reverse($array) as $item) {
            echo '"'.$item.'",';
       }
       unset($array);
      @endphp
      ],
      datasets: [
            {
                  label: "Belum Bayar",
                  fillColor: "rgba(220,220,220,0.2)",
                  strokeColor: "rgba(220,220,220,1)",
                  pointColor: "rgba(220,220,220,1)",
                  pointStrokeColor: "#fff",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(220,220,220,1)",
                  data: [
                  @php
                  for ($i=0; $i <= 11; $i++) {
                        $bulan = explode('-', date("m-Y", strtotime("-" . $i - 1 . " months")))[0];
                        $tahun = explode('-', date("m-Y", strtotime("-" . $i - 1 . " months")))[1];
                        $array[] = helper()->belumBayar($bulan, $tahun);            
                  }
                  foreach (array_reverse($array) as $item) {
                        echo '"'.$item.'",';
                   }
                   unset($array);
                  @endphp
                  ]
            }
      ]
};
var ctxl = $("#chartBelumBayar").get(0).getContext("2d");
var lineChart = new Chart(ctxl).Line(data, {
 responsive : true,
 animation: true,
 barValueSpacing : 5,
 barDatasetSpacing : 1,
 tooltipFillColor: "rgba(0,0,0,0.8)",                
 multiTooltipTemplate: "<%= datasetLabel %> - <%= value %>"
});
</script>
@endsection