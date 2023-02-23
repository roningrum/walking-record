<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function update(User $user, Request $request){

        $validator = Validator::make($request->all(),[
            'name'=>'required|string',
            'email'=>'required|email',
            // 'password'=>'required|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('kode_user', $request->kode_user);
        $user->update([
            'name' => $request->name,
            'email'=>$request->email
        ]);
        return response()->json(['message'=>'sukses diubah','data'=>$user->get()]);
    }

    //ubah password

    public function updatePassword(User $user, Request $request){
        $validator = Validator::make($request->all(),[
            'password'=>['required','string',Password::min(8)->mixedCase()],
            // 'password'=>'required|min:8'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('kode_user', $request->kode_user);
        $user->update([
            'password' => Hash::make($request->password),
        ]);
        dd($user->password());
        return response()->json(['message'=>'sukses diubah','data'=>$user->get()]);
    }
}
