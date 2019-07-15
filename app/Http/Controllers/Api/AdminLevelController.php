<?php

namespace App\Http\Controllers\Api;

use App\Models\Auth\Country;
use App\Models\Auth\CountryAdminLevel;
use App\Models\Auth\HasAdminLevel;
use Illuminate\Http\Request;
use JWTAuth;

class AdminLevelController extends APIcontroller
{
    /**
     *
     *
     * @SWG\Get(
     *      path="/auth/user/countryadmin/{country_id}",
     *      operationId="api.auth.user.countryadmin",
     *      tags={"country admin"},
     *      summary="Get communities",
     *      description="Get fdp communities",
     *

     *      @SWG\Parameter(
     *          name="country_id",
     *          description="country id",
     *          required=true,
     *          type="integer",
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="token",
     *          description="authentication token",
     *          required=true,
     *          type="string",
     *          in="query"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation"
     *       ),
     *      @SWG\Response(response=401, description="Invalid Credentials")
     *
     * )
     *
     */

    public function districtVillage(Request $request, Country $country)
    {

        $user = JWTAuth::authenticate($request->token);
        $levels = HasAdminLevel::where('level',2)
        ->where('country_id',$country->id)->first();

        $districts = CountryAdminLevel::where('type',$levels->name)
            ->where('country_id',$country->id)->get();

        $dataBuilder = array();

        foreach( $districts as $district){

            $responseBuilder = array(
                'id' => $district->id,
                'district' => $district->name,
                'communities' => CountryAdminLevel::where('parent_id',$district->id)->get()
            );

            array_push($dataBuilder,$responseBuilder);
        }


        if($user)
        {
            return response()->json(['data' => $dataBuilder],200);

        }else{
            return response()->json(['error' => 'invalid_token'], 401);
        }


    }
}
