<?php

namespace App\Http\Controllers\Api;

use App\Models\Auth\Country;
use App\Models\Survey\Form;
use App\Models\Survey\Question;
use App\Models\Survey\QuestionMap;
use App\Models\Survey\SkipLogic;
use Illuminate\Http\Request;
use JWTAuth;

class SurveyController extends APIcontroller
{


    /**
     *
     *
     * @SWG\Get(
     *      path="/auth/user/survey/{country_id}",
     *      operationId="api.auth.user.survey",
     *      tags={"survey"},
     *      summary="Get survey questions and skip logic",
     *      description="Returns questions and skip logic",
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

 public function  question(Request $request,Country $country)

 {

     $user = JWTAuth::authenticate($request->token);

      $country =  Country::find($country->id);

      $translations = $country->formTranslation();
      $dataBuilder = array();




      $formTranslation = $translations->get();


         //loop through form translation to get questions to populate json
      foreach($formTranslation as $translation)
      {

          $questions = Question::where('form_translation_id',$translation->id)->get();
          $questionbuilder = array();
            if(count($questions)>0) {
                foreach ($questions as $question) {

                    $questionData = array(
                        'question' => $question,
                        'skiplogic' => SkipLogic::where('question_id', $question->id)->get(),
                        'map' => QuestionMap::where('question_id', $question->id)->get()
                    );


                    array_push($questionbuilder, $questionData);

                }

                $responseBuilder = array(
                    'id' => $translation->id,
                    'name' => $translation->display_name_c,
                    'form_id' => $translation->form_id,
                    'form' => Form::find($translation->form_id),
                    'questions' => $questionbuilder,


                );

                unset($questionbuilder);
                array_push($dataBuilder, $responseBuilder);
            }

      }



     if($user)
     {
       return response()->json(['data' => $dataBuilder],200);

     }else{
         return response()->json(['error' => 'invalid_token'], 401);
     }


 }

}
