@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
	    <a href="javascript:;" class="headerButton goBack">
		    <ion-icon name="chevron-back-outline"></ion-icon>
	    </a>
    </div>
    <div class="pageTitle">Data Izin/Sakit</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection

@section('content')
<div class="row" style="margin-top:70px">
    <div class="col">
        @php
            $messagesuccess= Session::get('success');
            $messageerror= Session::get('error');
        @endphp
        @if(Session::get('success'))
        <div class="alert alert-success">
            {{$messagesuccess}}
        </div>
        @endif
        @if(Session::get('error'))
        <div class="alert alert-danger">
            {{$messageerror}}
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col">
    @foreach ($dataizin as $d)
        <ul class="listview image-listview">
            <li>
                <div class="item">
                    <div class="in">
                        <div>
                            <b>{{date("d-m-Y",strtotime($d->tgl_izin))}} ({{$d->status == "s" ? "Sakit" : "Izin"}})</b><br>
                            <small class="text-muted">{{$d->keterangan}}</small>
                        </div>
                        @if ($d->status_approved ==0)
                        <span class="badge bg-warning">Menunggu</span>
                        @elseif ($d->status_approved ==1)
                        <span class="badge bg-success">Disetujui</span>
                        @elseif ($d->status_approved ==2)
                        <span class="badge bg-danger">Ditolak</span>
                        @endif
                    </div>
                </div>
            </li>   
        </ul>
    @endforeach
    </div>
</div>
<!-- source code baru -->
<!-- <div class="fab-button animate bottom-right dropdown" style="margin-bottom:70px">
    <a href="#" class="fab bg-primary" data-toggle="dropdown">
        <ion-icon name="add-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
    </a>
    <div class="dropdown-menu">
        <a class="dropdown-item bg-primary" href="/pengajuanizin/createizinabsen">
            <ion-icon name="document-outline" role="img" class="md hydrated" aria-label="image outline"></ion-icon>
            <p>Izin Absen</p>
        </a>
        <a class="dropdown-item bg-primary" href="/pengajuanizin/createsakit">
            <ion-icon name="document-outline" role="img" class="md hydrated" aria-label="videocam outline"></ion-icon>
            <p>Sakit</p>
        </a>
        <a class="dropdown-item bg-primary" href="/pengajuanizin/createcuti">
            <ion-icon name="document-outline" role="img" class="md hydrated" aria-label="videocam outline"></ion-icon>
            <p>Cuti</p>
        </a>
    </div>
</div> -->
<!-- source code lama -->
<div class="fab-button bottom-right" style="margin-bottom:70px;">
    <a href="/presensi/buatizin" class="fab">
        <ion-icon name="add-outline"></ion-icon>
    </a>
</div>
@endsection