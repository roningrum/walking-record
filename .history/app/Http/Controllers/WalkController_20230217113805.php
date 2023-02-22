<?php

namespace App\Http\Controllers;

use App\Http\Resources\WalkResource;
use App\Models\Walk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WalkController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $walk = Walk::all();
        return $this->sendResponse(WalkResource::collection($walk),'Sukses');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required|max:25',
            'langkah_terekam'=>'required|integer|max:1000',
        ]);

        Walk::create([
            'id' => $request->id,
            'nama' => $request->nama,
            'langkah_terekam'=>$request->langkah_terekam,
            'recorded_at'=>Carbon::now()
        ]);
        return $this->sendResponse(new WalkResource($request), 'Record berhasil ditambahkan');

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
