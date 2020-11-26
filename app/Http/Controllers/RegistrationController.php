<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegistrationController extends BaseApiController
{

    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
          'name' => 'required|min:4',
          'email' => 'required|email|unique:users',
          'password' => 'required|min:8',
        ]);

        $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('EventToken')->accessToken;

        return $this->sendResponse(true, 200,
          "User Registered Successfully", ['token' => $token]);
    }
}
