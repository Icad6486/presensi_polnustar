<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $query = Pegawai::query ();
        $query->select('pegawai.*','nama_unit');
        $query->join('tabel_unit','pegawai.kode_unit','=','tabel_unit.kode_unit');
        $query->orderBy('nama_lengkap');
        if(!empty($request->nama_pegawai)){
            $query->where('nama_lengkap','like','%'.$request->nama_pegawai.'%');
        }
        if(!empty($request->kode_unit)){
            $query->where('pegawai.kode_unit',$request->kode_unit);
        }
        $pegawai = $query->paginate(2);

        $unit_kerja = DB::table('tabel_unit')->get();
        return view('pegawai.index',compact('pegawai','unit_kerja'));
    }
}
