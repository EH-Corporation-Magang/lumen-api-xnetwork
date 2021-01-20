<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DigitalAds;

class DigitalAdsController extends Controller
{
    // get all
    public function getAll()
    {
        $data = DigitalAds::all();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'All Data', 'result' => $data], 200);
    }

    // create data
    public function createData(Request $request)
    {
        // get image
        if ($request->hasFile('image')) {
            $original_filename = $request->file('image')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/imageads/';
            $image = 'M-' . time() . '.' . $file_ext;
            $request->file('image')->move($destination_path, $image);
            $imageads = 'http://localhost:8000/upload/imageads/' . $image;
        } else {
            return response()->json(['success' => false, 'status' => 200, 'message' => 'Failed to get image'], 200);
        }

        $title = $request->input('title');
        $subtitle = $request->input('subtitle');
        $description = $request->input('description');

        $data = [
            "image" => $imageads,
            "title" => $title,
            "subtitle" => $subtitle,
            "description" => $description
        ];

        if (DigitalAds::create($data)) {
            return response()->json(['success' => true, 'status' => 200, 'message' => 'Data was created successfully', 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'status' => 404, 'message' => 'Data created failed', 'data' => $data], 200);
        }
    }

    // show data reference id
    public function getId($id)
    {
        $data = DigitalAds::where('id', $id)->first();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'Data Detail', 'data' => $data], 200);
    }

    // edit data
    public function editData(Request $request, $id)
    {
        $data = DigitalAds::find($id);

        // get = image
        if ($request->hasFile('image')) {
            $original_filename = $request->file('image')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/imageads/';
            $image = 'M-' . time() . '.' . $file_ext;
            $request->file('image')->move($destination_path, $image);
            if (!substr($data->image, 38)) {
                $imageads = 'http://localhost:8000/upload/imageads/' . $image;
            } else {
                $imageads = 'http://localhost:8000/upload/imageads/' . $image;
                unlink(base_path('public/upload/iconapps/' . substr($data->image, 38)));
            }
        } else {
            $imageads = $data->image;
        }

        $data->update([
            'image' => $imageads,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description
        ]);

        return response()->json(['success' => true, 'status' => 200, 'message' => 'Data was edited successfully'], 200);
    }

    // delete data
    public function deleteData($id)
    {
        $data = DigitalAds::where('id', $id)->first();
        if (!substr($data->image, 38)) {
            return response('null');
        } else {
            unlink(base_path('public/upload/imageads/' . substr($data->image, 38)));
        }
        $data->delete();
        return response('Berhasil Menghapus Product');
    }
}
