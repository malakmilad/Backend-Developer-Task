<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken(name: 'token')->plainTextToken;
        return response()->json([
            'status'  => 200,
            'token' => $token,
            'message' => 'Register Successfully',
            'data'    => new UserResource($user),
        ], 200);
    }
    public function login(LoginRequest $request)
    {
        $email       = $request->email;
        $password    = $request->password;
        $user        = User::where('email', '=', $email)->first();
        $token = $user->createToken('token')->plainTextToken;
        if ($user && Hash::check($password, $user->password)) {
            return response()->json([
                'status'  => 200,
                'token' => $token,
                'message' => 'Login Successfully',
                'data'    => new UserResource($user),
            ], 200);
        } else {
            return response()->json([
                'status'  => 401,
                'message' => 'Wrong Email Or Password',
            ], 401);
        }
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'status'  => 200,
            'message' => 'Logged out successfully',
        ], 200);
    }
}
