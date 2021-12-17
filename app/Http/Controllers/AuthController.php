<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register (Request $request) {
        try {
            $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $token = $user->createToken('auth_token')->plainTextToken;

            return response()->json([
                'name' =>  $validatedData['name'],
                'email' =>  $validatedData['email'],
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
        }

    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password'))) {
        return response()->json([
        'message' => 'Invalid login details'
                ], 401);
            }

        $user = User::where('email', $request['email'])->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
                'email' =>  $user->email,
                'access_token' => $token,
                'token_type' => 'Bearer',
        ]);
    }

    public function updateUser($id) {

        $user = User::where('password_reset' , $id)->first();

        if($user) {
            return view('Auth.updatePassword', ['user' => $user]);
        } else {
            return(404);
        }

    }

    public function updateUsersPassword(Request $request) {
        $user = User::where('password_reset' , $request->get('password_reset_token'))->first();
        if($user) {
            $user->password = Hash::make($request->get('password'));
            if($user->save()) {
                return view('Auth.successUpdate');
            }
            else {
                abort(500);
            }
        }


    }

}
