<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Hash;
use App\Models\User;

class UserController extends Controller
{
    //register user
    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed'
        ]);


        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);


        return response()->json([
            'status' => true,
            'message' => 'User Registation Successfully!'
        ]);




    }

    //login user
    public function login(Request $request)
    {
        $login_data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if (!auth()->attempt($login_data)) {
            
            return response()->json([
                "status" => false,
                "message" => "Invalid Credentials"
            ]);
        }


        $token = auth()->user()->createToken("my_token")->accessToken;

        return response()->json([
            "status" => true,
            "message" => "User Logged Successfully!",
            "access_token" => $token
        ]);


    }

     // user profile
    public function profile($id)
    {

        $user_logged = auth()->user();

        return response()->json([

            "status" => true,
            "message" => "User Data",
            "data" => $user_logged
        ]);

    }

     // user logout
    public function logout(Request $request)
    {
        $token = $request->user()->token();

        $token->revoke();


        return response()->json([
            "status" => true,
            "message" => "User Logged Out Successfully!"
        ]);

    }
}
