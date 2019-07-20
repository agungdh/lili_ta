@extends('template.template')

@section('title')
Laporan Bulanan
@endsection

@section('nav')
<li><a href="{{ base_url() }}laporan"><i class="fa fa-home"></i> Laporan Bulanan</a></li>
@endsection

@section('content')
<form>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-primary">

        <div class="box box-body">

          <div class="col-md-6">
            <div class="form-group has-feedback">
              <label for="bulan">Bulan</label>
              <select class="form-control select2" name="bulan" id="bulan">
                <option value="1">Januari</option>
                <option value="2">Februari</option>
                <option value="3">Maret</option>
                <option value="4">April</option>
                <option value="5">Mei</option>
                <option value="6">Juni</option>
                <option value="7">Juli</option>
                <option value="8">Agustus</option>
                <option value="9">September</option>
                <option value="10">Oktober</option>
                <option value="11">November</option>
                <option value="12">Desember</option>
              </select>
            </div>
          </div>

          <div class="col-md-6">
            <div class="form-group has-feedback">
              <label for="tahun">Tahun</label>
              <input min="1900" max="2900" type="number" name="tahun" id="tahun" class="form-control">
            </div>
          </div>

          <button type="button" class="btn btn-success" id="btnCetak">Cetak Laporan</button>

        </div>
          
      </div>
    </div>
  </div>
</form>
@endsection

@section('js')
<script type="text/javascript">
  function cetak() {
    if ($("#tahun").val() == '') {
      return false;
    }

    var win = window.open(`{{base_url()}}laporan/cetak/${$("#bulan").val()}/${$("#tahun").val()}`, '_blank');
    win.focus();
  }

  $("form").submit(function(e) {
    e.preventDefault();
    cetak();
  });

  $("#btnCetak").click(function() {
    cetak();    
  });
</script>
@endsection