<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A4 }
  #title{
    font-family: Book Antiqua;
    font-size: 16px;
    font-weight: bold;
  }
  .tabeldatapegawai{
    margin-top:30px;
  }

  .tabeldatapegawai td{
    padding: 1px;
  }

  .tabelpresensi{
    width:100%;
    margin-top:20px;
    border-collapse:collapse;
  }

  .tabelpresensi tr th {
      border: 1px solid #131212;
      padding:4px;
      background-color: #e6e6e6;
  }

  .tabelpresensi tr td {
      border: 1px solid #131212;
      padding:2px;
      
  }

  .foto{
    width:40px;
    height:30px;
  }
  </style>
</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">

  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">

    <table style="width:100%">
        <tr>
            <td style="width:30px">
                <img src="{{asset('assets/img/logopresensi.png')}}" width="100" height="100" alt="">
            </td>
            <td>
                <span id="title">POLITEKNIK NEGERI NUSA UTARA <br>
                    LAPORAN PRESENSI <br>
                    PERIODE {{strtoupper($namabulan[$bulan])}} {{$tahun}}<br>
                </span>
                <span><i>Jln. Kesehatan No. 1, Sawang Bendar</i></span>
            </td>
        </tr>
    </table>
    <table class="tabeldatapegawai">
      <tr>
        <td rowspan="7">
          @php
          $path = Storage::url('uploads/pegawai/'.$pegawai->foto)
          @endphp          
          <img src="{{url($path)}}" alt="" width="100" height="120">
        </td>
      </tr>
      <tr>
        <td>NIK/NIP</td>
        <td>:</td>
        <td>{{$pegawai->nik}}</td>
      </tr>
      <tr>
      <tr>
        <td>N a m a </td>
        <td>:</td>
        <td>{{$pegawai->nama_lengkap}}</td>
      </tr>
      <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>{{$pegawai->jabatan}}</td>
      </tr>
      <tr>
        <td>Unit Kerja</td>
        <td>:</td>
        <td>{{$pegawai->nama_unit}}</td>
      </tr>
      <tr>
        <td>No. HP</td>
        <td>:</td>
        <td>{{$pegawai->no_hp}}</td>
      </tr>
    </table>
    <table class="tabelpresensi">
      <tr>
        <th>No.</th>
        <th>Tanggal</th>
        <th>Jam Masuk</th>
        <th>Foto</th>
        <th>Jam Keluar</th>
        <th>Foto</th>
        <th>Keterangan</th>
      </tr>
      @foreach ($presensi as $d)

      @php
      $path_in = Storage::url('uploads/absensi/' .$d->foto_in);
      $path_out = Storage::url('uploads/absensi/' .$d->foto_out);
      @endphp 
      <tr>
        <td>{{$loop->iteration}}</td>
        <td>{{date("d-m-Y",strtotime($d->tgl_presensi))}}</td>
        <td>{{$d->jam_masuk}}</td>
        <td><img src="{{url($path_in)}}" alt="" class="foto"></td>
        <td>{{$d->jam_keluar !=null ? $d->jam_keluar : 'Belum Absen'}}</td>
        <td><img src="{{url($path_out)}}" alt="" class="foto"></td>
        <td>
          @if ($d->jam_masuk > '08:00:00')
            Terlambat
          @else
            Tepat Waktu
          @endif
        </td>
      </tr>
      @endforeach

    </table>

  </section>

</body>

</html>