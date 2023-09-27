<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\support\Facades\Redirect;

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
        $pegawai = $query->paginate(10);

        $unit_kerja = DB::table('tabel_unit')->get();
        return view('pegawai.index',compact('pegawai','unit_kerja'));
    }

    public function store(Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_unit = $request->kode_unit;
        $password = hash::make('12345');        
        if ($request->hasfile('foto')){
            $foto = $nik. "." .$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = null;
        }

        try {
            $data = [
                'nik' => $nik,
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_unit' => $kode_unit,
                'foto' => $foto,
                'password' => $password
            ];
            $simpan = DB::table('pegawai')->insert($data);
            if ($simpan){
                if ($request->hasFile('foto')){
                    $folderPath="public/uploads/pegawai/";
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data berhasil disimpan']);
            } 
        } catch (\Exception $e) {
            //dd($e->message);
            return Redirect::back()->with(['warning' => 'Data gagal disimpan']);
        }
    }

    public function edit(Request $request)
    {
        $nik = $request->nik;
        $unit_kerja = DB::table('tabel_unit')->get();
        $pegawai = DB::table('pegawai')->where('nik', $nik)->first();
        return view ('pegawai.edit', compact('unit_kerja','pegawai'));
    }

    public function update ($nik, Request $request)
    {
        $nik = $request->nik;
        $nama_lengkap = $request->nama_lengkap;
        $jabatan = $request->jabatan;
        $no_hp = $request->no_hp;
        $kode_unit = $request->kode_unit;
        $password = hash::make('12345'); 
        $old_foto=$request->old_foto;    
        if ($request->hasfile('foto')){
            $foto = $nik. "." .$request->file('foto')->getClientOriginalExtension();
        } else {
            $foto = $old_foto;
        }

        try {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'jabatan' => $jabatan,
                'no_hp' => $no_hp,
                'kode_unit' => $kode_unit,
                'foto' => $foto,
                'password' => $password
            ];
            $update = DB::table('pegawai')->where('nik',$nik)->update($data);
            if ($update){
                if ($request->hasFile('foto')){
                    $folderPath="public/uploads/pegawai/";
                    $folderPathOld="public/uploads/pegawai/" . $old_foto;
                    Storage::delete($folderPathOld);
                    $request->file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success' => 'Data berhasil di update']);
            } 
        } catch (\Exception $e) {
            //dd($e->message);
            return Redirect::back()->with(['warning' => 'Data gagal di update']);
        }
    }

    public function delete($nik){
        $delete = DB::table('pegawai')->where('nik',$nik)->delete();
        if ($delete){
            return Redirect::back()->with(['success'=>'Data berhasil dihapus']);
        }else{
            return Redirect::back()->with(['warning'=>'Data gagal dihapus']);
        }
    }
}
