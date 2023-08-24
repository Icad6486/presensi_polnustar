<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\support\Facades\Redirect;

class PresensiController extends Controller
{
    public function create()
    {
        $hariini = date("Y-m-d");
        $nik = Auth::guard('pegawai')->user()->nik;
        $cek = DB::table('presensi')->where('tgl_presensi',$hariini)->where('nik', $nik)->count();
        return view('presensi.create',compact('cek'));
    }

    public function store(Request $request)
    {
        $nik = Auth::guard('pegawai')->user()->nik;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");        
        $latitudekantor=3.6103044;
        $longitudekantor=125.4873136;
        $lokasi = $request->lokasi;
        $lokasiuser =explode(",", $lokasi);
        $latitudeuser= $lokasiuser[0];
        $longitudeuser= $lokasiuser[1];
        
        $jarak = $this->distance($latitudekantor,$longitudekantor,$latitudeuser,$longitudeuser);
        $radius = round($jarak["meters"]);
       
        $cek = DB::table('presensi')->where('tgl_presensi',$tgl_presensi)->where('nik', $nik)->count();

        if ($cek>0){
            $ket = "out";
        }else{
            $ket = "in";
        }
        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nik . "-". $tgl_presensi."-".$ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;
               
        if($radius > 100){
            echo "error|Maaf Anda Berada Diluar Radius, jarak Anda ".$radius." meter dari Kantor|radius";
        }else{
        
        if($cek >0){
            $data_pulang = [
                'jam_keluar'=>$jam,
                'foto_out'=>$fileName,
                'lokasi_out'=>$lokasi
            ];
            $update = DB::table('presensi')->where('tgl_presensi',$tgl_presensi)->where('nik',$nik)->update($data_pulang);
            if($update){
                echo "success|Terima kasih, Hati-hati di jalan|out";
                Storage::put($file,$image_base64);
            } else {
            echo "error|Maaf Gagal Absen, Hubungi Kepegawaian|out";
            } 
        }else{

            $data = [
                'nik'=>$nik,
                'tgl_presensi'=>$tgl_presensi,
                'jam_masuk'=>$jam,
                'foto_in'=>$fileName,
                'lokasi_in'=>$lokasi
            ];
    
            $simpan = DB::table('presensi')->insert($data);
            if($simpan){
                echo "success|Terima kasih, Selamat Bekerja|in";
                Storage::put($file,$image_base64);
            } else {
            echo "error|Maaf Gagal Absen, Hubungi Kepegawaian|in";
            }   
        }
    }
        
    }

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    public function editprofile()
    {
        $nik= Auth::guard('pegawai')->user()->nik;
        $pegawai=DB::table('pegawai')->where('nik',$nik)->first();
        
        return view ('presensi.editprofile', compact('pegawai'));
    }

    public function updateprofile(Request $request)
    {
        $nik= Auth::guard('pegawai')->user()->nik;
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $password = hash::make($request->password);
        $pegawai =DB::table('pegawai')->where('nik', $nik)->first();
        if($request->hasfile('foto')){
            $foto = $nik. "." .$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = $pegawai->foto;
        }
        if(empty($request->password)){
            $data = [
                'nama_lengkap'=>$nama_lengkap,
                'no_hp'=>$no_hp,
                'foto'=>$foto
        ];
        }else{
            $data = [
                'nama_lengkap'=>$nama_lengkap,
                'no_hp'=>$no_hp,
                'password'=>$password,
                'foto'=>$foto
            ];  
        }
        $update=DB::table('pegawai')->where('nik', $nik)->update($data);
        if($update){
            if ($request->hasFile('foto')){
                $folderPath="public/uploads/pegawai/";
                $request->file('foto')->storeAs($folderPath, $foto);
            }
            return redirect('/editprofile')->with(['success'=>'Data Berhasil Di Update']);
        }else{
            return redirect('/editprofile')->with(['error'=>'Data Gagal Di Update']);
        }
    }

    public function histori()
    {
        $namabulan =["","Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        return view('presensi.histori',compact('namabulan'));
    }

    public function gethistori(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $nik=Auth::guard('pegawai')->user()->nik;

        $histori=DB::table('presensi')
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->where('nik',$nik)
        ->orderBy('tgl_presensi')
        ->get();
        
        return view ('presensi.gethistori',compact('histori'));
    }

    public function izin()
    {
        $nik = Auth::guard('pegawai')->user()->nik;
        $dataizin = DB::table('pengajuan_izin')->where('nik',$nik)->get();
        return view ('presensi.izin', compact ('dataizin'));
    }

    public function buatizin()
    {
        return view ('presensi.buatizin');
    }

    public function storeizin(Request $request)
    {
        $nik= Auth::guard('pegawai')->user()->nik;
        $tgl_izin = $request->tgl_izin;
        $status = $request->status;
        $keterangan = $request->keterangan;

        $data =[
            'nik' => $nik,
            'tgl_izin'=> $tgl_izin,
            'status' => $status,
            'keterangan' => $keterangan
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);

        if ($simpan){
            return redirect('/presensi/izin')->with(['success'=>'Data berhasil disimpan']);
        } else {
            return redirect('/presensi/izin')->with(['error'=>'Data gagal disimpan']);
        }
    }
}
 