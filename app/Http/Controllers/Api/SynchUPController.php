<?php

namespace App\Http\Controllers\Api;

use App\Jobs\SynchUp;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;
class SynchUPController extends Controller
{


    public function received_data(Request $request){

        SynchUp::dispatch($request->all());
        return response()->json('Data is been proccessed!!',201);
    }

}
