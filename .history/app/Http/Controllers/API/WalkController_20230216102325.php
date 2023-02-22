<?php

namespace App\Http\API\Controllers;

use App\Http\Resources\WalkResource;
use App\Models\Walk;
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
        //
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'langkah_terekam'=>'required',
            'recorded_at'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendErro('Validation Error', $validator->errors());
        }

        $walk = Walk::create($input);

        return $this->sendResponse(new WalkResource($walk), 'Record berhasil ditambahkan');

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
