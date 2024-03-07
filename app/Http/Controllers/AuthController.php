<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Models\User;


class AuthController extends Controller
{
   public function proseslogin(request $request){
    
    if(Auth::guard('karyawan')->attempt(['nik'=> $request->nik, 'password'=> $request->password])){
       return redirect('/Dashboard');
    } else{
        return redirect('/')->with(['warning' => 'Nik Atau Password Salah']);
    }
    }
    public function proseslogout(){
        if(Auth::guard('karyawan')->check()){
           Auth::guard('karyawan')->logout();
        return redirect('/');
    }
    }
}
