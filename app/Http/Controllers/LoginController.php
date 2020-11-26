<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends BaseApiController
{

    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
          'email' => $request->email,
          'password' => $request->password,
        ];

        if (auth()->attempt($data)) {
            $data['token'] = auth()
              ->user()
              ->createToken('LaravelAuthApp')->accessToken;

            return $this->sendResponse(true, 200,
              "User Logged In Successfully", ['data' => $data]);
        } else {
            return $this->sendResponse(false, 401,
              "Unauthorised");
        }
    }
}
