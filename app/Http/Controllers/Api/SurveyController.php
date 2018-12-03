<?php

namespace App\Http\Controllers\Api;

use App\Models\Auth\Country;
use App\Models\Auth\Form;
use App\Models\Auth\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class SurveyController extends Controller
{
    //

 public function  question(Request $request,Country $country)
 {
     $user = JWTAuth::authenticate($request->token);
     

     $country =  Country::find($country->id);

    // dd($country);
      $translations = $country->formTranslation();

      $dataBuilder = array();


      $formTranslation = $translations->get();

      foreach($formTranslation as $translation)
      {

          $responseBuilder = array(
              'id' => $translation->id,
              'name'=> $translation->display_name_c,
              'form' => Form::find($translation->form_id),
              'question' => array(Question::where('form_translation_id',$translation->id)->get())

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
