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
        $users = User::find($kode_user);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);

        if($users->save()){
            return response()->json(['message'=> 'sukses di ubah']);
        }
    }
}
