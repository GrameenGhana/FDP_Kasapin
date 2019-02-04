<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTFactory;
use JWTAuth;


class LoginController extends APIcontroller
{
    /**
     * Login for a mobile user's account.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     *
     * @SWG\Post(
     *     path="/auth/user/login",
     *     tags={"user"},
     *     operationId="api.auth.user.login",
     *     summary="Login as field Coordinator",
     *     produces={ "application/json"},
     *     @SWG\Parameter(
     *     name="email",
     *     in="query",
     *     type="string",
     *     description="login email",
     *     required=true,
     *      ),
     *     @SWG\Parameter(
     *         name="password",
     *         in="query",
     *         type="string",
     *         description="login password",
     *         required=true,
     *     ),
     *
     *      @SWG\Response(
     *         response=200,
     *         description="Successful Operation."
     *
     *     ),
     *     @SWG\Response(
     *         response=401,
     *         description="Invalid Credentials."
     *     ),
     *    @SWG\Response(
     *         response=500,
     *         description="Could not create token"
     *     )
     * )
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
