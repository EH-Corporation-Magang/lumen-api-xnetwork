<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // get All
    public function getAll()
    {
        $data = User::all();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'All User', 'result' => $data], 200);
    }

    // create data
    public function createData(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:6',
        ]);

        $username = $request->input("username");
        $email = $request->input("email");
        $password = $request->input("password");

        if ($request->hasFile('gambar_user')) {
            $original_filename = $request->file('gambar_user')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/user/';
            $image = 'U-' . time() . '.' . $file_ext;
            $request->file('gambar_user')->move($destination_path, $image);
            $imageuser = 'http://localhost:8000/upload/user/' . $image;
        } else {
            return $this->responseRequestError('File not found');
        }

        $hashPwd = Hash::make($password);

        $data = [
            "username" => $username,
            "email" => $email,
            "password" => $hashPwd,
            "gambar_user" => $imageuser
        ];

        if (User::create($data)) {
            $out = [
                "success" => true,
                "message" => "register_success",
                "code"    => 201,
            ];
        } else {
            $out = [
                "success" => false,
                "message" => "failed_regiser",
                "code"   => 404,
            ];
        }
        return response()->json(['success' => true, 'status' => 200, 'message' => 'Success add user'], 200);
    }

    public function show($id)
    {
        $data = User::where('id', $id)->first();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'User Detail', 'data' => $data], 200);
    }

    public function editData(Request $request, $id)
    {
        $user = User::find($id);
        $password = $request->password != '' ? app('hash')->make($request->password) : $user->password;
        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $password
        ]);

        return response()->json(['success' => true, 'status' => 200, 'message' => 'User Update Succesfully'], 200);
    }

    // delete data
    public function deleteData($id)
    {
        $data = User::where('id', $id)->first();
        unlink(base_path('public/upload/user/' . substr($data->gambar_user, 34)));
        $data->delete();

        return response('Berhasil Menghapus User');
    }
}
