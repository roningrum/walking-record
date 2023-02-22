<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255| unique:users',
            'password' => 'required|string|min:8'
        ]);

        $cek = User::count();
        if($cek==0){
            $table_no = '001';
            $tgl = substr(str_replace( '-', '', Carbon::now()),0,8);
            $no = $tgl.$table_no;
        }
        else{
            $ambil= User::orderBy('id', 'DESC')->first();
            $table_no = (int)substr($ambil->kode_user, -3)+1;
            $tgl = substr(str_replace( '-', '', Carbon::now()),0,8);
            $no = $tgl.$table_no;
        }

        // $table_no = User::max('kode_user');
       
        // $auto=substr($no,8);
        // $auto=intval($auto)+1;
        // $kode_user=substr($no,0,8).str_repeat(0,(4-strlen($auto))).$auto;

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=>Hash::make($request->password),
            'kode_user'=>$no
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        // return ApiFormatter::createApi(200, 'Sukses', $user, $token);
        return response()->json(['message'=>'sukses','data'=>$user, 'access_token'=>$token, 'token_type'=>'Bearer'], 200);

    }

   public function login(Request $request){
    if(!Auth::attempt($request->only('email', 'password'))){
        return response()->json(['message'=> 'Gagal Login'], 401);
    }
    $user = User::where('email', $request['email'])->firstorFail();
    $token = $user->createToken('auth_token')->plainTextToken;
    return response()->json(
        [
            'message'=>'Selamat Datang, '.$user->name,
            'access_token'=> $token,
        ]
    );
   }

   public function logout(){
    auth()->user()->tokens()->delete();
    return[
        'message'=>'Sampai Jumpa'
    ];
   }
}
