<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class KanyeController extends Controller
{
    public function index()
    {
        return view('kanye.index');
    }

    public function user_login()
    {
        return view('kanye.auth.login');
    }

    public function fetchQuotes()
    {
        $getdata = [];
        $i = 0;
        for ($i = 0; $i < 5; $i++) {
            $response = json_decode(file_get_contents('https://api.kanye.rest/quotes?count=5'), true);
            $getdata[] = $response;
        }
        return response()->json(array('status' => true, 'data' => $getdata));
    }

    public function userSubmit(Request $request)
    {
        // dd('hello');
        try {
            $rules = [

                'email' => 'required | email ',
                'password' => 'required',
            ];

            $validater = Validator::make($request->all(), $rules);

            if ($validater->fails()) {
                return response()->json(array('status' => false, 'msg' => $validater->errors()->first()));
            }
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password])) {
               return redirect()->route('home.page');
            }
        } catch (\Exception $ex) {
            return response()->json(array('status' => false, 'msg' => $ex->getMessage()));
        }
    }
}
