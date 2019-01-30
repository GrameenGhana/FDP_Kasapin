<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Auth\Crop;
use App\Models\Auth\RecommendationCalculation;
use App\Models\Auth\RecommendationActivity;
use App\Models\Auth\InputPrice;
use App\Http\Controllers\Controller;
use JWTAuth;

/**
 *
 *
 * @SWG\Get(
 *      path="/auth/user/recommendation/{crop_id}",
 *      operationId="api.auth.user.recommendation",
 *      tags={"recommendation"},
 *      summary="Get recommendations and calculations",
 *      description="Returns recommendations and calculations",
 *
 *      @SWG\Parameter(
 *          name="crop_id",
 *          description="crop id",
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


class RecommendationController extends Controller
{
   public function recommendation(Request $request,Crop $crop)
   {
       $user = JWTAuth::authenticate($request->token);

       $dataBuilder = array();
       $recommendations = $crop->Recommendation()->get();

       foreach($recommendations as $recommendation)
       {
           $responseBuilder = array(
              'id' => $recommendation->id,
               'crop_id'  =>$recommendation->crop_id,
               'label'   => $recommendation->label_c,
               'hierarchy' => $recommendation->hierarchy_c,
               'condition' => $recommendation->condition_c,
               'change_condition' => $recommendation->change_condition_c,
               'change_option' => $recommendation->change_option_c,
               'country'     => $recommendation->country_id,
               'calculations' => RecommendationCalculation::where('recommendation_id',$recommendation->id)->get(),
               'activity' => RecommendationActivity::where('recommendation_id',$recommendation->id)->get()
           );


           array_push($dataBuilder ,$responseBuilder);
       }



     if($user)
     {
         return response()->json(['data' => $dataBuilder],200);

     }else{
         return response()->json(['error' => 'invalid_token'], 401);
     }

   }

    /**
     *
     *
     * @SWG\Get(
     *      path="/auth/user/input/{crop_id}",
     *      operationId="api.auth.user.input",
     *      tags={"input"},
     *      summary="Get inputs and input_price",
     *      description="Returns inputs and input_price",
     *
     *      @SWG\Parameter(
     *          name="crop_id",
     *          description="crop id",
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


    public function input(Request $request,Crop $crop)
  {

      $user = JWTAuth::authenticate($request->token);

      $dataBuilder = array();

      $inputs = $crop->Input()->get();

      foreach($inputs as $input)
      {
              $responseBuilder = array(
                  'id'      => $input->id,
                  'crop_id' => $input->crop_id,
                  'name'    => $input->name_c,
                  'type'    => $input->type_,
                  'unit'    => $input->unit_c,
                  'cost'    => $input->cost_c,
                  'input_price' => InputPrice::where('input_id',$input->id)->get()
              );

          array_push($dataBuilder ,$responseBuilder);
      }



      if($user)
      {
          return response()->json(['data' => $dataBuilder],200);

      }else{
          return response()->json(['error' => 'invalid_token'], 401);
      }


  }

}
