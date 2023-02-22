<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Update($kode_user, Request $request){

        $validasi = $request->validate([
            'name'=>'required',
            'email'=> 'required|email|unique',
            'password'=>'required|min:8'
        ]);

        $validasi['name'] = $request->name;
        $validasi['email'] = $request->email;
        $validasi['password']=Hash::make($request->password);

        $data = User::where('kode_user', $kode_user)->update($validasi);

        return response()->json(['message'=>'sukses','data'=>$data]);




        // $users = User::find($kode_user);    
        $users->update($request->all);
        if($users->save()){
            return response()->json(['message'=> 'sukses di ubah', 'data'=> $users]);
        }
    }
}
