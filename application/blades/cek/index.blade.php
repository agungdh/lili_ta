<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="{{base_url()}}assets/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="{{base_url()}}assets/AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{base_url()}}assets/AdminLTE/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="{{base_url()}}assets/AdminLTE/dist/css/AdminLTE.min.css">
	<link rel="stylesheet" href="{{base_url()}}assets/AdminLTE/dist/css/skins/_all-skins.min.css">
  
</head>
<body class="hold-transition skin-blue-light fixed sidebar-mini">
	
			<div class="row" id="rowtableajaxbulantahunbelumbayar">
			  <div class="col-md-12">
			    <div class="box box-primary">
			            <div class="box-header">
			              <h3 class="box-title">Data Bulan Tahun Belum Bayar</h3>
			            </div>
			            <!-- /.box-header -->
			            <div class="box-body">
			                <div id="tableajaxbulantahunbelumbayar"></div>
			            </div>
			            <!-- /.box-body -->
			          </div>
			  </div>
			</div>
		

	<script src="{{base_url()}}assets/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="{{base_url()}}assets/AdminLTE/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="{{base_url()}}assets/AdminLTE/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="{{base_url()}}assets/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="{{base_url()}}assets/AdminLTE/dist/js/adminlte.min.js"></script>
	
	<script type="text/javascript">
	$('.datatable').DataTable({
	  responsive: false,
	  "scrollX": true
	});

	$(function() {
	  getAjaxTable();
	});

	function getAjaxTable(id = null) {
    if (id) {
        var idUrl = id;
    } else {
        var idUrl = '';
    }

    $.ajax({
      type: "GET",
      url: `{{base_url()}}kendaraan/ajaxtablebelumbayar/{{$pemilikKendaraan->id}}`,
      data: {
        
      },
      success: function(data, textStatus, xhr ) {
        if (typeof b !== 'undefined') {
          b.destroy();
        }

        $("#tableajaxbulantahunbelumbayar").html(data);
      },
      error: function(xhr, textStatus, errorThrown) {
        console.table([
          {
            kolom: 'xhr',
            data: xhr
          },
          {
            kolom: 'textStatus',
            data: textStatus
          },
          {
            kolom: 'errorThrown',
            data: errorThrown
          }
        ]);

        swal('ERROR !!!', 'See console !!!', 'error');
      }
    });
}
	</script>
</body>
</html>