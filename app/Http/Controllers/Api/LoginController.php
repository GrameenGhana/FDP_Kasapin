<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTFactory;
use JWTAuth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    /**
     * Agent Login
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //

      $credentials = $request->only('email','password');


      try{
            if(!$token = JWTAuth::attempt($credentials))
            {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
      }
      catch (JWTException $ex ){

          return response()->json(['error' => 'could_not_create_token'], 500);
      }

      return response()->json(compact('token'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


}
