@extends('template.template')

@section('title')
Transaksi
@endsection

@section('nav')
@include('transaksi.nav')
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Data Transaksi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if(getUserData()->level == 'o')
                <a class="btn btn-success btn-sm" href="{{base_url()}}transaksi/tambah">
                  <i class="glyphicon glyphicon-plus"></i> Tambah
                </a><br><br>
              @endif

                <div class="form-group has-feedback">
                    <select class="select2" id="pemilikkendaraan">
                        <option value="">Pilih Pemilik Kendaraan</option>
                        @foreach($pemilikKendaraans as $item)
                        <option value="{{$item->id}}">{{$item->nama}}</option>
                        @endforeach
                    </select>
                </div>
              
                <div id="tableajax"></div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
</div>

<div id="transaksiUtang">
  
</div>
@endsection

@section('js')
<script type="text/javascript">
function hapus(id) {
    swal({
      title: "Yakin Hapus ???",
      text: "Data yang sudah dihapus tidak dapat dikembalikan lagi !!!",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#DD6B55",
      confirmButtonText: "Hapus",
    }, function(){
      window.location = "{{base_url()}}transaksi/aksihapus/" + id;
    });
}

$("#pemilikkendaraan").change(function() {
  $("#transaksiUtang").html('');
  getAjaxTable($("#pemilikkendaraan").val());
});

$(function() {
  getAjaxTable();
});

function getAjaxTable(id = null) {
    if (id) {
        var idUrl = id;

        // $.ajax({
        //   type: "GET",
        //   url: `{{base_url()}}transaksi/ajaxtablekendaraan/${idUrl}`,
        //   data: {
            
        //   },
        //   success: function(data, textStatus, xhr ) {
        //     $("#transaksiUtang").html(data);
        //   },
        //   error: function(xhr, textStatus, errorThrown) {
        //     console.table([
        //       {
        //         kolom: 'xhr',
        //         data: xhr
        //       },
        //       {
        //         kolom: 'textStatus',
        //         data: textStatus
        //       },
        //       {
        //         kolom: 'errorThrown',
        //         data: errorThrown
        //       }
        //     ]);

        //     swal('ERROR !!!', 'See console !!!', 'error');
        //   }
        // });
    } else {
        var idUrl = '';
    }

    $.ajax({
      type: "GET",
      url: `{{base_url()}}transaksi/ajaxtable/${idUrl}`,
      data: {
        
      },
      success: function(data, textStatus, xhr ) {
        if (typeof a !== 'undefined') {
          a.destroy();
        }

        $("#tableajax").html(data);
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
@endsection