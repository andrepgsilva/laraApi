<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRegister;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\BaseController;

class RegisterController extends BaseController
{
    public function register(UserRegister $request)
    {
        $validated = $request->validated();
        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->name;
        return $this->sendResponse($success, 'User register successfully');
    }
}
