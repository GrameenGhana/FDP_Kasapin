<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Auth\Crop;
use App\Http\Controllers\Controller;
use JWTAuth;

class RecommendationController extends Controller
{
   public function recommendation(Request $request,Crop $crop)
   {
       $user = JWTAuth::authenticate($request->token);

       if($user){

          
           return $crop->Recommendation()->get();
       }

   }

}
