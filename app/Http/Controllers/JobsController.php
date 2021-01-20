<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;

class JobsController extends Controller
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
        $data = Job::all();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'All Job', 'result' => $data], 200);
    }

    // create data
    public function createData(Request $request)
    {
        $data = new Job();
        $data->job_position = $request->input('jobposition');
        $data->job_location = $request->input('joblocation');
        $data->job_description = $request->input('jobdescription');
        $data->job_link = $request->input('joblink');
        $data->save();

        return response()->json(['success' => true, 'status' => 200, 'message' => 'Job was created successfully'], 200);
    }

    // getId
    public function getId($id)
    {
        $data = Job::where('id', $id)->first();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'Job Detail', 'data' => $data], 200);
    }

    // edit data
    public function editData(Request $request, $id)
    {
        $data = Job::where('id', $id)->first();
        $data->job_position = $request->input('jobposition');
        $data->job_location = $request->input('joblocation');
        $data->job_description = $request->input('jobdescription');
        $data->job_link = $request->input('joblink');
        $data->save();

        return response()->json(['success' => true, 'status' => 200, 'message' => 'Job was edited successfully'], 200);
    }

    // delete data
    public function deleteData($id)
    {
        $data = Job::where('id', $id)->first();
        $data->delete();

        return response('Berhasil Menghapus Jobs');
    }
}
