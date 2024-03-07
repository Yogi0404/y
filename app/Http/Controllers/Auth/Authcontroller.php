<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class Authcontroller extends Controller
{
    private $response=[
        'message'=>null,
        'data'=>null
    ];

    public function register(Request $req){
        $req->validate([
                'name'=>'required',
                'email'=>'required',
                'password'=>'required'
            ]);
            $data=User::create([
                'name'=>$req->name,
                'email'=>$req->email,
                'password'=>Hash::make($req->password)
            ]);
            $this->response['message']='success';
            return response()->json($this->response, 200);
    }




    public function login(Request $request){
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Lakukan autentikasi dan berikan respons sesuai hasil
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            //$token['token'] = $user->createToken('tokenapi')->accessToken;
            $token=$user->createToken('API')->plainTextToken;
            return response()->json(['token' => $token]);
        } else {
            return response()->json(['token' => 'gagal'], 401);
        }

    }

    public function me(){
        $user=Auth::user();
        $this->response['message']='success';
        $this->response['data']=$user;
        return response()->json($this->response, 200);

    }
    public function logout(){
        $logout=auth()->user()->currentAccessToken()->delete();
        $this->response['message']='success';
        return response()->json($this->response, 200);

    }


}
