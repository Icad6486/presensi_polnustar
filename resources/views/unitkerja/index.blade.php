@extends('layouts.admin.tabler')
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
            <!-- Page pre-title -->            
            <h2 class="page-title">
                Data Unit Kerja
            </h2>
            </div>
        </div>
    </div>
</div>
<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-12">                                
                                @if (Session::get('success'))
                                <div class="alert alert-success">
                                    {{Session::get('success')}}                              
                                </div>
                                @endif
                                
                                @if (Session::get('warning'))
                                <div class="alert alert-warning">
                                    {{Session::get('warning')}}
                                </div>
                                @endif     
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <a href="#" class="btn btn-primary" id="btnTambahunitkerja">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                    </svg>
                                    Tambah Data
                                </a>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <form action="/unitkerja" method="GET">
                                    <div class="row">
                                        <div class="col-10">
                                            <div class="form-group">
                                                <input type="text" name="nama_unit" id="nama_unit" class="form-control" placeholder="Unit Kerja" value="{{Request('nama_unit')}}">
                                            </div>
                                        </div>
                                        
                                        <div class="col-2">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                    <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0"></path>
                                                    <path d="M21 21l-6 -6"></path>
                                                    </svg>
                                                    Cari
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Unit</th>
                                            <th>Nama Unit Kerja</th>                                           
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($unit_kerja as $d)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td>{{$d->kode_unit}}</td>
                                                <td>{{$d->nama_unit}}</td>
                                                <td>
                                                <div class="btn-group">
                                                    <a href="#" class="edit btn btn-info btn-sm" kode_unit="{{$d->kode_unit}}">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                                        <path d="M16 5l3 3"></path>
                                                        </svg>
                                                    </a>
                                                    <form action="/unitkerja/{{ $d->kode_unit }}/delete" method="POST" style="margin-left:5px">
                                                        @csrf                                                                                                               
                                                        <a class="btn btn-danger btn-sm delete-confirm">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                            <path d="M4 7l16 0"></path>
                                                            <path d="M10 11l0 6"></path>
                                                            <path d="M14 11l0 6"></path>
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                                            </svg>
                                                        </a>

                                                    </form>
                                                </div>
                                                </td>
                                            </tr>
                                        @endforeach                                     
                                    </tbody>
                                </table>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="modal-inputunitkerja" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Unit Kerja</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/unitkerja/store" method="POST" id="frmUnitkerja">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-border-corners" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                                <path d="M20 16v2a2 2 0 0 1 -2 2h-2"></path>
                                <path d="M8 20h-2a2 2 0 0 1 -2 -2v-2"></path>
                                <path d="M4 8v-2a2 2 0 0 1 2 -2h2"></path>
                                </svg>
                            </span>
                            <input type="text" value="" id="nik" class="form-control" name="kode_unit" placeholder="Kode Unit">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-building-community" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M8 9l5 5v7h-5v-4m0 4h-5v-7l5 -5m1 1v-6a1 1 0 0 1 1 -1h10a1 1 0 0 1 1 1v17h-8"></path>
                                    <path d="M13 7l0 .01"></path>
                                    <path d="M17 7l0 .01"></path>
                                    <path d="M17 11l0 .01"></path>
                                    <path d="M17 15l0 .01"></path>
                                </svg>
                            </span>
                            <input type="text" value="" id="nama_unit" class="form-control" name="nama_unit" placeholder="Nama Unit Kerja">
                        </div>
                    </div>
                </div>
                
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="form-group">
                            <button class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M10 14l11 -11"></path>
                                <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5"></path>
                                </svg>
                            Simpan
                            </button>
                        </div>
                    </div>
                </div>
            </form>
          </div>          
        </div>
      </div>
    </div>
<!-- Modal Edit -->
    <div class="modal modal-blur fade" id="modal-editunitkerja" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Unit Kerja</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="loadeditform">
            
          </div>          
        </div>
      </div>
    </div>
@endsection
@push('myscript')
<script>
    $(function(){
        $("#btnTambahunitkerja").click(function(){
            $("#modal-inputunitkerja").modal("show");
        });

        $(".edit").click(function(){
            var kode_unit = $(this).attr('kode_unit');           
            $.ajax({
                type:'POST'
                ,url:'/unitkerja/edit'
                ,cache:false
                ,data:{
                    _token:"{{csrf_token();}}"
                    , kode_unit : kode_unit
                },
                success:function(respond){
                    $("#loadeditform").html(respond);
                }
            });            
            $("#modal-editunitkerja").modal("show");
        });

        $(".delete-confirm").click(function(e){
            var form =$(this).closest('form');
            e.preventDefault();

            Swal.fire({
            title: 'Apakah data ini akan di hapus ?',
            text: "Jika Ya, data akan dihapus permanen !",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'Tidak',
            confirmButtonText: 'Ya !'
            }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
                Swal.fire(
                'Deleted!',
                'Data berhasil dihapus.',
                'success'
                )
            }
            })            
        });

        $("#frmPegawai").submit(function(){
            var nik = $("#nik").val();
            var nama_lengkap = $("#nama_lengkap").val();
            var jabatan = $("#jabatan").val();
            var no_hp = $("#no_hp").val();
            var kode_unit=$("frmPegawai").find("#kode_unit").val();
            if(nik==""){
                //alert('NIK/NIP harus di isi');
                Swal.fire({
                    title: 'Warning!',
                    text: 'NIK/NIP harus di isi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then(()=>{
                    $("#nik").focus();
                });                
                return false;
                
            }else if(nama_lengkap==""){
                Swal.fire({
                    title: 'Warning!',
                    text: 'Nama harus di isi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then(()=>{
                    $("#nama_lengkap").focus();
                });                
                return false;

            }else if(jabatan==""){
                Swal.fire({
                    title: 'Warning!',
                    text: 'Jabatan harus di isi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then(()=>{
                    $("#jabatan").focus();
                });                
                return false;

            }else if(no_hp==""){
                Swal.fire({
                    title: 'Warning!',
                    text: 'No. HP harus di isi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then(()=>{
                    $("#no_hp").focus();
                });                
                return false;

            }else if(kode_unit==""){
                Swal.fire({
                    title: 'Warning!',
                    text: 'Unit Kerja harus di isi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                }).then(()=>{
                    $("#no_hp").focus();
                });                
                return false;
            }
        });
    });
</script>
@endpush