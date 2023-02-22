<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    //
    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255| unique:users',
            'password' => 'required|string|min:8'
        ]);

        $table_no = '0001';
        $tgl = substr(str_replace( '-', '', Carbon::now()),0,8);
        $no = $tgl.$table_no;
        $auto=substr($no,8);
        $auto=intval($auto)+1;
        $kode_user=substr($no,0,8).str_repeat(0,(4-strlen($auto))).$auto;

        if($validator->fails()){
            return response()->json($validator->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password'=>Hash::make($request->password),
            'kode_user'=>$kode_user
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;
        // return ApiFormatter::createApi(200, 'Sukses', $user, $token);
        return response()->json(['message'=>'sukses','data'=>$user, 'access_token'=>$token, 'token_type'=>'Bearer']);

    }
}
