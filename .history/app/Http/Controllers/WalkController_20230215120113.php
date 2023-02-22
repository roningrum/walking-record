<?php

namespace App\Http\Controllers;

use App\Models\Walk;
use Illuminate\Http\Request;
use DataTables;
use Yajra\DataTables\DataTables as DataTablesDataTables;
use Yajra\DataTables\Facades\DataTables as FacadesDataTables;

class WalkController extends Controller
{
    //
    public function index(){
        return view('walk-monitor');
    }

    // get table walk record
    public function getWalkings(Request $request){
        if($request->ajax()){
            $data = Walk::latest()->get();
            return DataTablesDataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
    }
}
