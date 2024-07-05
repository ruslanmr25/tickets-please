<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ApiLoginRequest;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponses;
    public function login(ApiLoginRequest $request)
    {

        if (!Auth::attempt($request->only(['email', 'password']))) {

            return $this->error("Invalid credentials", 401);
        }
        $user = Auth::user();

        return $this->success(
            message: "Authenticated",
            data: [
                "token" => $user->createToken("Api token")->plainTextToken
            ]

        );
    }

    public function register()
    {
        return $this->success("Register Form");
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return $this->success();
    }
}
