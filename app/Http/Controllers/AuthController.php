<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function proseslogin(Request $request)
    {
        // echo "Berhasil Login";

        // $pass=123;
        // echo hash::make ($pass);

        if (Auth::guard('pegawai')->attempt(['nik' => $request->nik, 'password' => $request->password])){
            return redirect('/dashboard');
        } else {
            return redirect('/')->with(['warning'=>'Nik atau Password tidak sesuai']);
        }
        
    }

    public function proseslogout(){
        if(Auth::guard('pegawai')->check()){
            Auth::guard('pegawai')->logout();
            return redirect('/');

        }
    }

    public function proseslogoutadmin(){        
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
            return redirect('/panel');

        }
    }

    public function prosesloginadmin(Request $request)
    {
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('/panel/dashboardadmin');
        } else {
            return redirect('/panel')->with(['warning'=>'Username atau Password salah']);
        }
        
    }
}
