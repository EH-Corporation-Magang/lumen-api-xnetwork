<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
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
        $data = Product::all();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'All Product', 'result' => $data], 200);
    }

    // create data
    public function createData(Request $request)
    {
        // get icon image
        if ($request->hasFile('icon')) {
            $original_filename = $request->file('icon')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/iconapps/';
            $image = 'A-' . time() . '.' . $file_ext;
            $request->file('icon')->move($destination_path, $image);
            $iconapps = 'http://localhost:8000/upload/iconapps/' . $image;
        }

        // get image
        if ($request->hasFile('image')) {
            $original_filename = $request->file('image')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/imageapps/';
            $image = 'I-' . time() . '.' . $file_ext;
            $request->file('image')->move($destination_path, $image);
            $imageapps = 'http://localhost:8000/upload/imageapps/' . $image;
        }

        $description = $request->input('description');
        $titlefiture1 = $request->input('titlefiture1');
        $titlefiture2 = $request->input('titlefiture2');
        $titlefiture3 = $request->input('titlefiture3');
        $titlefiture4 = $request->input('titlefiture4');
        $titlefiture5 = $request->input('titlefiture5');
        $titlefiture6 = $request->input('titlefiture6');
        $fiture1 = $request->input('fiture1');
        $fiture2 = $request->input('fiture2');
        $fiture3 = $request->input('fiture3');
        $fiture4 = $request->input('fiture4');
        $fiture5 = $request->input('fiture5');
        $fiture6 = $request->input('fiture6');


        $data = [
            "icon" => $iconapps,
            "image" => $imageapps,
            "description" => $description,
            "titlefiture1" => $titlefiture1,
            "fiture1" => $fiture1,
            "titlefiture2" => $titlefiture2,
            "fiture2" => $fiture2,
            "titlefiture3" => $titlefiture3,
            "fiture3" => $fiture3,
            "titlefiture4" => $titlefiture4,
            "fiture4" => $fiture4,
            "titlefiture5" => $titlefiture5,
            "fiture5" => $fiture5,
            "titlefiture6" => $titlefiture6,
            "fiture6" => $fiture6,
        ];

        if (Product::create($data)) {
            return response()->json(['success' => true, 'status' => 200, 'message' => 'Product was created successfully', 'data' => $data], 200);
        } else {
            return response()->json(['success' => false, 'status' => 404, 'message' => 'Product created failed', 'data' => $data], 200);
        }
    }

    // show data reference id
    public function getId($id)
    {
        $data = Product::where('id', $id)->first();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'Product Detail', 'data' => $data], 200);
    }

    // edit data
    public function editData(Request $request, $id)
    {
        $product = Product::find($id);

        // get icon image
        if ($request->hasFile('icon')) {
            $original_filename = $request->file('icon')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/iconapps/';
            $image = 'A-' . time() . '.' . $file_ext;
            $request->file('icon')->move($destination_path, $image);
            if (!substr($product->icon, 42)) {
                $iconapps = 'http://localhost:8000/upload/iconapps/' . $image;
            } else {
                $iconapps = 'http://localhost:8000/upload/iconapps/' . $image;
                unlink(base_path('public/upload/iconapps/' . substr($product->icon, 42)));
            }
        } else {
            $iconapps = $product->icon;
        }

        // get image
        if ($request->hasFile('image')) {
            $original_filename = $request->file('image')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/imageapps/';
            $image = 'I-' . time() . '.' . $file_ext;
            $request->file('image')->move($destination_path, $image);
            if (!substr($product->image, 42)) {
                $imageapps = 'http://localhost:8000/upload/imageapps/' . $image;
            } else {
                $imageapps = 'http://localhost:8000/upload/imageapps/' . $image;
                unlink(base_path('public/upload/imageapps/' . substr($product->image, 39)));
            }
        } else {
            $imageapps = $product->image;
        }

        $product->update([
            'icon' => $iconapps,
            'image' => $imageapps,
            'description' => $request->description,
            'titlefiture1' => $request->titlefiture1,
            'fiture1' => $request->fiture1,
            'titlefiture2' => $request->titlefiture2,
            'fiture2' => $request->fiture2,
            'titlefiture3' => $request->titlefiture3,
            'fiture3' => $request->fiture3,
            'titlefiture4' => $request->titlefiture4,
            'fiture4' => $request->fiture4,
            'titlefiture5' => $request->titlefiture5,
            'fiture5' => $request->fiture5,
            'titlefiture6' => $request->titlefiture6,
            'fiture6' => $request->fiture6
        ]);

        return response()->json(['success' => true, 'status' => 200, 'message' => 'Product was edited successfully'], 200);
    }

    // delete data
    public function deleteData($id)
    {
        $data = Product::where('id', $id)->first();
        if (!substr($data->icon, 38)) {
            return response('null');
        } else {
            unlink(base_path('public/upload/iconapps/' . substr($data->icon, 38)));
        }

        if (!substr($data->image, 38)) {
            return response('null');
        } else {
            unlink(base_path('public/upload/imageapps/' . substr($data->image, 38)));
        }
        $data->delete();
        return response('Berhasil Menghapus Product');
    }
}
