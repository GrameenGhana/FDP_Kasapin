<?php

namespace App\Http\Controllers\Api;

use App\Jobs\SynchUp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller as Controller;
class SynchUPController extends Controller
{


    public function received_data(Request $request){
        Log::info(json_encode($request->all()));
        SynchUp::dispatch($request->all());
        return response()->json(['success' => 'true','message'=>'Data is been proccessed!!','statuscode'=>'201'],201);
    }

}
