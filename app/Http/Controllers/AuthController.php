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
        if (!$user) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
                'errors' => [
                    'email' => ['The provided email is incorrect.']
                ],
            ], 401);
        }

        if (!Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
                'errors' => [
                    'password' => ['The provided password is incorrect.']
                ],
            ], 401);
        }


        return response()->json(['data' => ["user" => new UserResource($user), 
            'accessToken' => $user->createToken('API Token')->accessToken,]], 200);
        
    }
   
}
