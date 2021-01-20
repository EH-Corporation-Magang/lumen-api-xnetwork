<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
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

    // get all but paginate
    public function getAllPaginate()
    {
        $data = Contact::paginate(5);
        return response()->json(['success' => true, 'status' => 200, 'message' => 'All Contact', 'result' => $data], 200);
    }

    // get all
    public function getAll()
    {
        $data = Contact::all();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'All Contact', 'result' => $data], 200);
    }

    // create data
    public function createData(Request $request)
    {
        $data = new Contact();
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->message = $request->input('message');
        $data->save();

        return response()->json(['success' => true, 'status' => 200, 'message' => 'Contact was created successfully'], 200);
    }

    // get id
    public function getId($id)
    {
        $data = Contact::where('id', $id)->first();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'Contact Detail', 'data' => $data], 200);
    }

    // edit data
    public function editData(Request $request, $id)
    {
        $data = Contact::where('id', $id)->first();
        $data->name = $request->input('name');
        $data->email = $request->input('email');
        $data->message = $request->input('message');

        $data->save();

        return response()->json(['success' => true, 'status' => 200, 'message' => 'Contact was edited successfully'], 200);
    }

    // delete data
    public function deleteData($id)
    {
        $data = Contact::where('id', $id)->first();
        $data->delete();

        return response('Berhasil Menghapus Contact');
    }

    // count data
    public function countData()
    {
        $data = Contact::all();
        $countdata = $data->count();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'Data Count', 'result' => $countdata], 200);
    }
}
