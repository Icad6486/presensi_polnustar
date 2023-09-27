<?php

namespace App\Http\Controllers;

use App\Models\Unitkerja;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Redirect;

class UnitkerjaController extends Controller
{
    public function index(Request $request)
    {
        $nama_unit = $request->nama_unit;
        $query = Unitkerja::query();
        $query ->select('*');
        if(!empty($nama_unit)){
            $query->where('nama_unit','like','%'.$nama_unit.'%');
        }
        $unit_kerja = $query->get();
        //$unit_kerja=DB::table('tabel_unit')->orderBy('kode_unit')->get();
        return view('unitkerja.index',compact('unit_kerja'));
    }

    public function store(Request $request)
    {
        $kode_unit = $request->kode_unit;
        $nama_unit = $request->nama_unit;
        $data = [
            'kode_unit' => $kode_unit,
            'nama_unit' => $nama_unit,
        ];

        $simpan = DB::table('tabel_unit')->insert($data);
        if ($simpan){
            return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
        }else{
            return Redirect::back()->with(['warning'=>'Data Gagal Disimpan']);
        }
    }

    public function edit(Request $request)
    {
        $kode_unit = $request->kode_unit;
        $unit_kerja=DB::table('tabel_unit')->where('kode_unit',$kode_unit)->first();
        return view('unitkerja.edit',compact('unit_kerja'));
    }

    public function update($kode_unit, Request $request)
    {
        $nama_unit = $request->nama_unit;
        $data = [
            'nama_unit'=> $nama_unit
        ];
        $update = DB::table('tabel_unit')->where('kode_unit',$kode_unit)->update($data);
        if($update){
            return Redirect::back()->with(['success'=>'Data Berhasil Di Update']);
        }else{
            return Redirect::back()->with(['warning'=>'Data Gagal Di Update']);
        }
    }

    public function delete($kode_unit)
    {
        $hapus = DB::table('tabel_unit')->where('kode_unit',$kode_unit)->delete();
        if($hapus){
            return Redirect::back()->with(['success'=>'Data Berhasil Di Hapus']);
        }else{
            return Redirect::back()->with(['warning'=>'Data Gagal Di Hapus']);
        }
    }
}
