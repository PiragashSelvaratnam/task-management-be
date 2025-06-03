<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        $user = User::whereEmail($data['email'])->first();

        if ($user && Hash::check($data['password'], $user->password)) {
            return response()->json(["user" => new UserResource($user), 
            'accessToken' => $user->createToken('API Token')->accessToken,], 200);
        }

        return response()->json([
            'message' => 'Incorrect email or password.',
            'state' => 'incorrect-credentials',
        ], 401);
        
    }
   
}
