@if ($histori->isEmpty())
<div class="alert alert-danger">
    <p>Belum ada data</p>
</div>
@endif
@foreach ($histori as $d)
<ul class="listview image-listview">
    <li>
        <div class="item">
            @php
                $path = Storage::url('uploads/absensi/'.$d->foto_in);
            @endphp
            <img src="{{url($path)}}" alt="image" class="image">
            <div class="in">
                <div>
                    <b>{{date("d-m-Y",strtotime($d->tgl_presensi))}}</b><br>
                    <!--dibawah di non aktfikan-->
                    {{--<small class="text-muted">{{$d->jabatan}}</small>--}}
                </div>
                <span class="badge {{$d->jam_masuk < "07:00:01" ? "bg-success" : "bg-warning" }}">
                    {{$d->jam_masuk}}
                </span>
                <span class="badge bg-danger">{{$d->jam_keluar}}</span>
            </div>
        </div>
    </li>   
</ul>
@endforeach