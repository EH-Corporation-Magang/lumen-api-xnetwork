<?php

namespace App\Http\Controllers;

use App\RadioCoverage;
use Illuminate\Http\Request;

class RadioCoveragesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    // get all
    public function getAll()
    {
        $data = RadioCoverage::all();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'All RadioCoverage', 'result' => $data], 200);
    }

    // create data
    public function createData(Request $request)
    {
        $data = new RadioCoverage();
        $data->provinsi = $request->input('provinsi');
        $data->kota = $request->input('kota');
        $data->stasiun_id = $request->input('stasiun_id');
        $data->fm = $request->input('fm');
        $data->save();

        return response()->json(['success' => true, 'status' => 200, 'message' => 'RadioCoverage was created successfully'], 200);
    }

    // get id
    public function getId($id)
    {
        $data = RadioCoverage::where('id', $id)->first();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'RadioCoverage Detail', 'data' => $data], 200);
    }

    // edit data
    public function editData(Request $request, $id)
    {
        $data = RadioCoverage::where('id', $id)->first();
        $data->provinsi = $request->input('provinsi');
        $data->kota = $request->input('kota');
        $data->stasiun_id = $request->input('stasiun_id');
        $data->fm = $request->input('fm');
        $data->save();

        return response()->json(['success' => true, 'status' => 200, 'message' => 'RadioCoverage was edited successfully'], 200);
    }

    // delete data
    public function deleteData($id)
    {
        $data = RadioCoverage::where('id', $id)->first();
        $data->delete();

        return response('Berhasil Menghapus Radio Coverage');
    }
}
