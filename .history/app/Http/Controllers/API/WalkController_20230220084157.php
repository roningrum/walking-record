<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use App\Models\Walk;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class WalkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Walk::all();
        if($data){
            return ApiFormatter::createApi(200, 'Sukses', $data);
        }else{
            return ApiFormatter::createApi(400, 'Gagal');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama' => 'required',
            'langkah_terekam'=>'required'
        ]);
        $recorded_at = Carbon::now();

        $walk = Walk::where('nama', '=', $request->nama);

            if($walk->first()){
                $walk->update([
                    'langkah_terekam' => $request->langkah_terekam
                ]);
            }
            else{
                $walk = Walk::create([
                    'nama' => $request->nama,
                    'langkah_terekam'=>$request->langkah_terekam,
                    'recorded_at'=>$recorded_at
                ]);
            }
           
            dd($walk);   
        // try{
            
         
        //     // $data = Walk::where('','=', $walk->id)->get();
        //     // return ApiFormatter::createApi(200, 'Sukses', $data);

        //     // foreach($data as $datas){
        //     //     $datas->replicate()
        //     //     ->fill(['id'=> $walk->id])
        //     //     ->save();
        //     // }
        //     // if($data){
               
               
        //     // }
        //     // else{
        //     //     return ApiFormatter::createApi(400, 'Gagal');
        //     // }

        // } catch(Exception $error){
        //     // dd($walk);
        //     return ApiFormatter::createApi(400, 'Gagal');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
