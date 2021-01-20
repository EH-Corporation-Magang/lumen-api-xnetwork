<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Radio;


class RadiosController extends Controller
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
        $data = Radio::all();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'All Radio', 'result' => $data], 200);
    }

    // create data
    public function createData(Request $request)
    {
        $data = new Radio();
        $data->fm_channel = $request->input('fm_channel');
        $data->kota = $request->input('kota');
        $data->save();

        return response()->json(['success' => true, 'status' => 200, 'message' => 'Radio was created successfully'], 200);
    }

    // get id
    public function getId($id)
    {
        $data = Radio::where('id', $id)->first();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'Radio Detail', 'data' => $data], 200);
    }

    // edit data
    public function editData(Request $request, $id)
    {
        $data = Radio::where('id', $id)->first();
        $data->fm_channel = $request->input('fm_channel');
        $data->kota = $request->input('kota');

        $data->save();

        return response()->json(['success' => true, 'status' => 200, 'message' => 'Radio was edited successfully'], 200);
    }

    // delete data
    public function deleteData($id)
    {
        $data = Radio::where('id', $id)->first();
        $data->delete();

        return response('Berhasil Menghapus Radio');
    }
}
