<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
//use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    //- Shows specific error (can be generic or as required)
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('API')->plainTextToken;
                return response()->json(['token' => $token]);
            } else {
                return response()->json(['error' => 'Wrong Password'], 401);
            }
        } else {
            return response()->json(['error' => 'No such user'], 401);
        }  
    }
}
