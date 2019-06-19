<?php

namespace App\Http\Controllers\Api;

use App\Models\Auth\Input;
use App\Models\Auth\InputActivity;
use App\Models\Auth\Recommendation;
use Illuminate\Http\Request;
use App\Models\Auth\Crop;
use App\Models\Auth\Country;
use App\Models\Auth\RecommendationCalculation;
use App\Models\Auth\RecommendationActivity;
use App\Models\Auth\Activity;
use App\Models\Auth\InputPrice;
use App\Http\Controllers\Controller;
use JWTAuth;

/**
 *
 *
 * @SWG\Get(
 *      path="/auth/user/recommendation/{crop_id}/{country_id}",
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
 *     @SWG\Parameter(
 *          name="country_id",
 *          description="country",
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
   public function recommendation(Request $request,Crop $crop,Country $country)
   {
       $user = JWTAuth::authenticate($request->token);

       $dataBuilder = array();
     //$recommendations = $crop->Recommendation()->get();
       $recommendations = Recommendation::where([["crop_id","=",$crop->id],["country_id","=",$country->id]])->get();

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
               'reco_name'  => $recommendation->reco_name_c,
               'calculations' => RecommendationCalculation::where('recommendation_id',$recommendation->id)->get(),
               'recommendation_activity' => RecommendationActivity::where('recommendation_id',$recommendation->id)->get()
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


    /**
     *
     *
     * @SWG\Get(
     *      path="/auth/user/activity/{country_id}",
     *      operationId="api.auth.user.activity",
     *      tags={"activity"},
     *      summary="Get activity translation and activities",
     *      description="Returns activity translation and activities",
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


  public function activityInfo(Request $request,Country $country)
  {
      $user = JWTAuth::authenticate($request->token);


      $translations = $country->ActivityTranslation()->get();

      $dataBuilder = array();


      foreach ($translations as $activityTranslation)
      {
          $activity = Activity::where('id',$activityTranslation->activity_id)->first();
          $recommendation_activities = RecommendationActivity::where('activity_id',$activity->id)->get();

           $activityBuilder = array(
               'id' => $activity->id,
               'crop_id' => $activity->crop_id,
               'name' => $activity->name_c,
               'recommendation_activity'=> $recommendation_activities);

          $responseBuilder = array(
                   'id' => $activityTranslation->id,
                   'country' => $activityTranslation->country_id,
                   'display_name' => $activityTranslation->display_name_c,
                   'activity' => $activityBuilder
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


    /**
     *
     *
     * @SWG\Get(
     *      path="/auth/user/inputactivity/{input_id}",
     *      operationId="api.auth.user.inputactivity",
     *      tags={"activity"},
     *      summary="Get input activity from inputs",
     *      description="Returns input activity from inputs",
     *
     *      @SWG\Parameter(
     *          name="input_id",
     *          description="input id",
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

  public function activityInputByInput(Request $request,Input $input)
  {
      $user = JWTAuth::authenticate($request->token);
      if($user){
          return  response()->json(['data' => $input->InputActivity()->get()],200);
      }
      else {
          return response()->json(['error' => 'invalid_token'], 401);
      }

  }

    /**
     *
     *
     * @SWG\Get(
     *      path="/auth/user/inputactivityre/{recommendation_activity_id}",
     *      operationId="api.auth.user.inputactivitybyrecommendationactivity",
     *      tags={"activity"},
     *      summary="Get input activity from recommendationactivity ",
     *      description="Returns input activity from recommendationactivity",
     *
     *      @SWG\Parameter(
     *          name="recommendation_activity_id",
     *          description="recommendation activity id",
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

    public function activityInputByRecommendationActivity(Request $request,RecommendationActivity $recommendationActivity)
    {
       $user = JWTAuth::authenticate($request->token);
        if($user){
            return  response()->json(['data' => $recommendationActivity->InputActivity()->get()],200);
        }
        else {
            return response()->json(['error' => 'invalid_token'], 401);
        }

    }

}
