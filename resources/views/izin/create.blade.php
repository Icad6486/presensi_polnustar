@extends('layouts.presensi')
@section('header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
<style>
    .datepicker-modal{
        max-height : 430px !important;
    }

    .datepicker-date-display{
        background-color : #007bff !important;
    }
</style>
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
	    <a href="javascript:;" class="headerButton goBack">
		    <ion-icon name="chevron-back-outline"></ion-icon>
	    </a>
    </div>
    <div class="pageTitle">Form Izin Absen</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection

@section('content')
<div class="row" style="margin-top:70px">
    <div class="col">
        <form method="POST" action="/presensi/storeizin" id="frmIzin">
            @csrf
            <div class="form-group">
                <input type="text" id="tgl_izin_dari" name="tgl_izin_dari" class="form-control datepicker" placeholder="Dari">
            </div>            
            <div class="form-group">
                <input type="text" id="tgl_izin_sampai" name="tgl_izin_sampai" class="form-control datepicker" placeholder="Sampai">
            </div>
            <div class="form-group">
                <input type="text" id="jml_hari" name="jml_hari" class="form-control datepicker" placeholder="Jumlah Hari">
            </div>    
            <div class="form-group">
                <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control" placeholder="Keterangan"></textarea>
            </div>
            <div class="form-group">
                <button class="btn btn-primary w-100">Kirim</button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('myscript')
<script>
var currYear = (new Date()).getFullYear();

$(document).ready(function() {
  $(".datepicker").datepicker({
    format: "yyyy-mm-dd"    
  });

  $("#frmIzin").submit(function(){
    var tgl_izin = $("#tgl_izin").val();
    var status = $("#status").val();
    var keterangan = $("#keterangan").val();

    if (tgl_izin==""){
        Swal.fire({
            title: 'Oopss !',
            text: 'Tanggal harus di isi',
            icon: 'warning'
        });
        return false;
    }else if (status==""){
        Swal.fire({
            title: 'Oopss !',
            text: 'Status harus di isi',
            icon: 'warning'
        });
        return false;
    }else if (keterangan==""){
        Swal.fire({
            title: 'Oopss !',
            text: 'Keterangan harus di isi',
            icon: 'warning'
        });
        return false;
    }
  });
});
</script>
@endpush