<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthController extends Controller
{
    public $loginAfterSignup = true;

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token =auth()->login($user);

        return $this->respondWithToken($token);
    }

    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password', 'name']);
        if (auth()->attempt($credentials)) {
           
            $token = $request->user()->createToken('invoice')->plainTextToken;
            $data = [
                'token' => $token,
                'user_id' => auth()->user()->id,
                'user_name' => auth()->user()->name,
                'user_email' => auth()->user()->email,
                'user_status' => auth()->user()->status,
            ];
            return $this->respondWithToken($data);
        }

        return response()->json(['error' => 'Unauthorized'], 401);
    }

    public function getAuthUser(Request $request)
    {
        return response()->json(auth()->user());
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message'=> 'Successfuly logged out']);
    }

    protected function respondWithToken($data)
    {
        return response()->json([
            'status'=>'success',
            'user'=>[
                'id'=>$data['user_id'],
                'name'=>$data['user_name'],
                'email'=>$data['user_email'],
                'status'=>$data['user_status'],
            ],
            'authorization'=>[
                'access_token' => $data['token'],
                'token_type' => 'bearer',
                'expires_in' => 3600,
            ]
        ], 200);
    }
}
