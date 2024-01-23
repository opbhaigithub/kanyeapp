<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class ApiAuthController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email'  => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Please Enter Password.',
            'email.email' => 'Invalid Email Format.',
            'password.required' => 'Please Enter Password.',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->first();
            return $this->apiResponse(false, $errors);
        }

        if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = $request->user()->createToken('api-token')->plainTextToken;

            return $this->apiResponse(true, 'success', ['token' => $token, 'user' => $user]);
        } else {
            return $this->apiResponse(false, 'Invalid Credentials. Please try again!!');
        }
    }

    public function get_quote(Request $request)
    {
        $user_id = null;
        $token = $request->header('Authorization');
        if ($token) {
            $token = str_replace('Bearer ', '', $token);

            $token = explode('|', $token);
            if (count($token) === 2) {
                $id = $token[0];
                $token = $token[1];
                $token = hash('sha256', $token);

                $check = PersonalAccessToken::where(['id' => $id, 'token' => $token])->first();
                $user_id = $check->tokenable_id;
            }
        }

        if ($user_id != null) {
            $getdata = [];
            $i = 0;
            for ($i=0; $i < 5 ; $i++) { 
                $response = json_decode(file_get_contents('https://api.kanye.rest/quotes?count=5'), true);
                $getdata[] = $response['quote'];
            }
            return $this->apiResponse(true, 'success', [ 'data' => $getdata]);
        }else{
            return $this->apiResponse(false, 'Api is down');
        }
    }
}
