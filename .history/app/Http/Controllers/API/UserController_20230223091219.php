<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    public function update(User $user, Request $request){

        $validator = Validator::make($request->all(), [
            'title'     => 'required',
            'content'   => 'required',
        ]);

        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=> 'required|email|unique',
            'password'=>'required|min:8'
        ]);

        $validasi = $request->validate([
          
        ]);

        if($validasi->fails())

        $validasi['name'] = $request->name;
        $validasi['email'] = $request->email;
        $validasi['password']=Hash::make($request->password);

        $data = User::where('kode_user', $kode_user)->update($validasi);

        return response()->json(['message'=>'sukses','data'=>$data]);
    }
}
