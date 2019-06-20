<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Support\Facades\DB;

class SynchDownController extends Controller
{

    public function sync_down_agronomist_data(Request $request){
        $countryID = $request->country_id;
        $surveyorID = $request->surveyor_id;
        $pstart = $request->pstart;
        $pend = $request->pend;
        $data =[];
        if($pend <=0 || empty($pstart) ){
            $pend = 20;
        }
        if($pstart < 0){
            $pstart = 0;
        }
        $sqltable= "CREATE TEMPORARY TABLE IF NOT EXISTS repfarmertemp (question_id integer ,form_id integer , country_id integer ,
        object_c varchar (300),field_c varchar (300))";
        $sqltrunc = "TRUNCATE TABLE repfarmertemp;";
        $sqlgenerate = "INSERT INTO repfarmertemp(question_id,form_id,country_id,object_c,field_c) SELECT q.id,f.form_id,f.country_id,m.object_c,m.field_c from question_c q join form_translation_c f on
            q.form_translation_id = f.id join map_c m on q.id = m.question_id where f.country_id ='$countryID'
";        $sql = "select * from repfarmertemp";
          $sql_get_all_farmers_under_agronomist = "SELECT id,respondent_id FROM submission_c WHERE surveyor_id = '$surveyorID'  limit $pstart,$pend   ";
          $sql_get_form_ids = "select id from  form_c";
         $count_total = DB::table('submission_c')->WHERE('surveyor_id',$surveyorID)->count();
          DB::statement($sqltable);
         DB::statement($sqltrunc);
         DB::statement($sqlgenerate);
         $farmers = DB::select($sql_get_all_farmers_under_agronomist);
        $farmIDS = DB::select($sql_get_form_ids);
         foreach($farmers as $farmer){
             $FIDS = [];
             foreach($farmIDS as $farmid) {
                 $sqldata = "select * from repfarmertemp where form_id = '$farmid->id'";
                 $bundledata = DB::select($sqldata);
                 $answers= [];
                 $static_farmer_data = [];
                 $table_name = 'farmer_c';
                 $static_farmer_data =['full_name_c','farmer_code_c	','educational_level_c','birthday_c','gender_c','farmer_photo_c'];
                     foreach($bundledata as $bundle){

                       $values = DB::table($bundle->object_c)->select($bundle->field_c." as dataout")->where('submission_id',$farmer->id)->get();

                       if($values->isEmpty()) {
                           $answers[$bundle->question_id]=null;
                       }
                       else {
                           $fields = json_decode($values, true);
                           $field = $fields[0]['dataout'];
                           if($bundle->field_c == 'birthday_c') {
                               $field = $this->strip_to_get($fields[0]['dataout']);
                           }

                           $answers[$bundle->question_id]=$field;
                       }
                 }
                     foreach ($static_farmer_data as $key => $value){
                         $stat = DB::table($table_name)->select($value." as datastat")->where('submission_id',$farmer->id)->get();

                         if($stat->isEmpty()) {
                             $static_farmer_build[$value]=null;
                         }
                         else {
                             $fiel= json_decode($stat, true);
                             $fied = $fiel[0]['datastat'];
                             if($value == 'birthday_c') {
                              $fied = $this->strip_to_get($fied);
                             }

                             $static_farmer_build[$value]=$fied;
                         }

                     }
                     $static_farmer_data["farmer_code"]=$farmer->respondent_id;
                     $FIDS[] = array("farmer_code"=>$farmer->respondent_id,"form_id"=>$farmid->id
                     ,"data"=>$answers);

                 //$FIDS[] =array('form_details_'.$farmid->id=>$answers);
             }
             $data[] = ["farmer"=>$static_farmer_build,'forms'=>$FIDS];
         }


        return response()->json(['success' => 'true','total_count'=>$count_total,'data'=>$data],200);
    }


    public function strip_to_get($date){
        if($date =="" || $date== null){
          return " ";
        }
        else{
        $split = explode('-',$date);
        return $split[0];
            }
    }
}
