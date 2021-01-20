<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class AuthController extends Controller
{
    public function register(Request $request)
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

        return response()->json($out, $out['code']);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6'
        ]);

        $email = $request->input("email");
        $password = $request->input("password");

        $user = User::where("email", $email)->first();

        if (!$user) {
            $out = [
                "message" => "login_failed",
                "code"    => 401,
                "result"  => [
                    "token" => null,
                ]
            ];
            return response()->json($out, $out['code']);
        }

        if (Hash::check($password, $user->password)) {
            $newtoken  = $this->generateRandomString();

            $user->update([
                'token' => $newtoken
            ]);

            $out = [
                "success" => true,
                "message" => "login_success",
                "code"    => 200,
                "result"  => [
                    "username" => $user->username,
                    "gambaruser" => $user->gambar_user,
                    "token" => $newtoken,
                    "iduser" => $user->id
                ]
            ];
        } else {
            $out = [
                "success" => true,
                "message" => "login_failed",
                "code"    => 401,
                "result"  => [
                    "username" => null,
                    "gambaruser" => null,
                    "token" => null,
                ]
            ];
        }

        return response()->json($out, $out['code']);
    }

    function generateRandomString($length = 80)
    {
        $karakkter = '012345678dssd9abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $panjang_karakter = strlen($karakkter);
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= $karakkter[rand(0, $panjang_karakter - 1)];
        }
        return $str;
    }

    public function logout(Request $data)
    {
        $token  = explode(' ', $data->header('Authorization'));
        $user = User::where('token', $token[1])->first();
        if ($user) {
            $user->token = null;
            $user->save();
            return response()->json(['success' => true, 'status' => 200, 'message' => 'Success Logout', 'data' => $user], 200);
        }
        return response()->json(['success' => false, 'status' => 400, 'message' => 'Failed Logout', 'data' => ''], 200);
    }

    public function show($id)
    {
        $data = User::where('id', $id)->first();
        return response()->json(['success' => true, 'status' => 200, 'message' => 'User Detail', 'data' => $data], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $password = $request->password != '' ? app('hash')->make($request->password) : $user->password;

        if ($request->hasFile('gambar_user')) {
            $original_filename = $request->file('gambar_user')->getClientOriginalName();
            $original_filename_arr = explode('.', $original_filename);
            $file_ext = end($original_filename_arr);
            $destination_path = './upload/user/';
            $image = 'U-' . time() . '.' . $file_ext;
            $request->file('gambar_user')->move($destination_path, $image);
            $imageuser = 'http://localhost:8000/upload/user/' . $image;
            unlink(base_path('public/upload/user/' . substr($user->gambar_user, 34)));
        }

        $filaname = $imageuser;

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'gambar_user' => $filaname,
            'password' => $password,
        ]);

        return response()->json(['success' => true, 'status' => 200, 'message' => 'User Update Succesfully'], 200);
    }

    public function index()
    {
        $data = User::all();
        return view('test', ['user' => $data]);
    }
}
