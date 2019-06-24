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
             $sql_plot_farmer = DB::table('plot_c')->where('submission_id',$farmer->id)->get();
             $sql_plot = "select * from repfarmertemp   where object_c = 'plot_c'";
             $plotdata = DB::select($sql_plot);
             foreach($farmIDS as $farmid) {
                 $sqldata = "select * from repfarmertemp where form_id = '$farmid->id'";

                 $bundledata = DB::select($sqldata);

                 $answers= [];
                 $static_farmer_data = [];
                 $table_name = 'farmer_c';
                 $static_farmer_data =['full_name_c','farmer_code_c	','educational_level_c','birthday_c','gender_c','farmer_photo_c'];
                     foreach($bundledata as $bundle){
        if($bundle->field_c == 'household_gps_lat_c,household_gps_long_c'){

            $values = DB::table($bundle->object_c)->select('household_gps_lat_c','household_gps_long_c')->where('submission_id', $farmer->id)->get();
            $fields = json_decode($values, true);
            $field1 = $fields[0]['household_gps_lat_c'];
            $field2 = $fields[0]['household_gps_long_c'];
            $answers[$bundle->question_id] = $field1.', '.$field2;
        }
        else {
            $values = DB::table($bundle->object_c)->select($bundle->field_c . " as dataout")->where('submission_id', $farmer->id)->get();

            if ($values->isEmpty()) {
                $answers[$bundle->question_id] = null;
            } else {
                $fields = json_decode($values, true);
                $field = $fields[0]['dataout'];
                if ($bundle->field_c == 'birthday_c') {
                    $field = $this->strip_to_get($fields[0]['dataout']);
                }

                $answers[$bundle->question_id] = $field;
            }
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
             $p_d_c = [];
             $p_dm_oa = [];
             $plot_dm_ao_all =[];
             foreach ($sql_plot_farmer as $plot_total) {

                 $sql_dm = "select * from repfarmertemp  where object_c = 'diagnostic_monitoring_c'";
                 ////$sql_ao = "select * from repfarmertemp  where object_c = 'diagnostic_monitoring_c'";
                 $plot_dm = DB::select($sql_dm);
                 foreach ($plotdata as $plot) {

                     $values = DB::table($plot->object_c)->select($plot->field_c . " as plot_c", 'external_id_c','age_c')->where('id', $plot_total->id)->get();

                     if ($values->isEmpty()) {
                         $p_d_c[$plot->field_c] = null;
                     } else {
                         $plot_sort = json_decode($values, true);
                         $field = $plot_sort[0]['plot_c'];
                         $p_d_c[$plot->field_c] = $field;
                     }
                 }
                 foreach ($plot_dm as $dm_values) {
                     $values = DB::table($dm_values->object_c)->select($dm_values->field_c . " as plot_dm", 'id', 'ph_c')->where('plot_id', $plot_total->id)->get();

                     if ($values->isEmpty()) {
                         $p_dm_oa[$dm_values->field_c] = null;
                     } else {
                         $plot_sort_dm = json_decode($values, true);
                         $field = $plot_sort_dm[0]['plot_dm'];
                         $p_dm_oa[$this->convert_to_snake_case($dm_values->field_c)] = $field;
                     }
                     if (isset($plot_sort_dm)) {
                         $ao = DB::table('observation_c')->select('observation_c', 'variable_c')->where('diagnostic_monitoring_id', $plot_sort_dm[0]['id'])->get();

                         foreach ($ao as $ao_values) {


                             $p_dm_oa[$this->convert_to_snake_case($ao_values->variable_c)] = $ao_values->observation_c;
                         }
                         $p_d_c['recommendation_id'] = $plot_sort_dm[0]['id'];
                         $p_d_c['ph_c'] = $plot_sort_dm[0]['ph_c'];
                     }
                 }

                 $p_d_c['age_c'] = $plot_sort[0]['age_c'];
                 $p_d_c['external_id_c'] = $plot_sort[0]['external_id_c'];
                 $p_d_c["farmer_code"] = $farmer->respondent_id;
                 $p_d_c["data"] = $p_dm_oa;
                 $plot_dm_ao_all [] = ['plot_info' => $p_d_c];
             }
             $data[] = ["farmer"=>$static_farmer_build,'plot_details'=>$plot_dm_ao_all,'forms'=>$FIDS];
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

    public function convert_to_snake_case($string){
        $string = str_replace(" ", "_", $string);
        return $string;
    }
}
