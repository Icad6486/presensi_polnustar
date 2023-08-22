@extends('layouts.admin.tabler')
@section('content')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
            <!-- Page pre-title -->            
            <h2 class="page-title">
                Data Pegawai
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
                                <form action="/pegawai" method="GET">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" name="nama_pegawai"class="form-control" placeholder="Nama Pegawai" value="{{Request('nama_pegawai')}}">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-group">
                                                <select name="kode_unit" id="kode_unit" class="form-select">
                                                    <option value="">Unit Kerja</option>
                                                    @foreach ($unit_kerja as $d)
                                                        <option {{ Request ('kode_unit') ==$d ->kode_unit ? 'selected' : ''}} value="{{$d->kode_unit}}">{{$d->nama_unit}}</option>
                                                    @endforeach
                                                </select>
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
                                            <th>NIP/NIK</th>
                                            <th>Nama</th>
                                            <th>Jabatan</th>
                                            <th>No. HP</th>
                                            <th>Foto</th>
                                            <th>Unit Kerja</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pegawai as $d)
                                        @php
                                            $path = Storage::url('uploads/pegawai/'.$d->foto);                                
                                        @endphp
                                        <tr>
                                            <td>{{$loop->iteration + $pegawai->firstItem() -1}}</td>
                                            <td>{{$d->nik}}</td>
                                            <td>{{$d->nama_lengkap}}</td>
                                            <td>{{$d->jabatan}}</td>
                                            <td>{{$d->no_hp}}</td>
                                            <td>
                                                @if (empty($d->foto))
                                                <img src="{{asset('assets/img/no-image.png')}}" class="avatar" alt="">
                                                @else
                                                <img src="{{url($path)}}" class="avatar" alt="">
                                                @endif
                                            </td>
                                            <td>{{$d->nama_unit}}</td>
                                            <td></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                Halaman {{ $pegawai->currentPage() }}<br>
                                Jumlah Pegawai: {{ $pegawai->total() }} orang<br>
                                Data perhalaman: {{ $pegawai->perPage() }}<br>
                                <br>
                                {{$pegawai->links()}}
                            </div>
                        </div>
                        
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection