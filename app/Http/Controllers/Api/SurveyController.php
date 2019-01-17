<?php

namespace App\Http\Controllers\Api;

use App\Models\Auth\Country;
use App\Models\Survey\Form;
use App\Models\Survey\Question;
use App\Models\Survey\SkipLogic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JWTAuth;

class SurveyController extends Controller
{
    //

 public function  question(Request $request,Country $country)

 {
    // dd($request->all());
     $user = JWTAuth::authenticate($request->token);



      $country =  Country::find($country->id);

      $translations = $country->formTranslation();
      $dataBuilder = array();
      $questionbuilder = array();

      $formTranslation = $translations->get();

      foreach($formTranslation as $translation)
      {
          $questions = Question::where('form_translation_id',$translation->id)->get();

          foreach ($questions as  $question)
          {

              $questionData = array(
                  'question' => $question,
                  'skiplogic' => SkipLogic::where('question_id',$question->id)->get(),
              );

              array_push($questionbuilder,$questionData);

          }


          $responseBuilder = array(
              'id' => $translation->id,
              'name'=> $translation->display_name_c,
              'form_id' => $translation->form_id,
              'form' => Form::find($translation->form_id),
              'questions' => $questionbuilder,


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
