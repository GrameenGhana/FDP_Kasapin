<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
   return $request->user();
});


Route::post('synchupdata','Api\SynchUPController@received_data');

Route::group(['prefix'=>'v1'],function(){



    Route::group(['namespace'=>'Api','prefix'=>'auth/user'],function(){

     Route::post('login','LoginController@login');

     //routes that need authentication
     Route::group(['middleware'=>'jwt.auth'],function (){
         Route::get('details', function(Request $request) {
             return auth()->user();
         });

         /*****
          * Assumptions
          * country should come from client
          *
          * crop id should come from client
          */
         Route::get('survey/{country}','SurveyController@question');
         Route::get('recommendation/{crop}','RecommendationController@recommendation');
         Route::get('input/{crop}','RecommendationController@input');
         Route::get('activity/{country}','RecommendationController@activityInfo');

     });


    });




});



