<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/8/18
 * Time: 11:42 AM
 */

namespace App\Repositories\Backend\Survey;

use App\Helpers\Auth\Auth;
use App\Helpers\General\SynchData;
use App\Models\Survey\Diagnostic_monitoring_c;
use App\Models\Survey\Farm_c;
use App\Models\Survey\farmer_baseline_c;
use App\Models\Survey\Farmer_c;
use App\Models\Survey\observation_c;
use App\Models\Survey\Plot_c;
use App\Models\Survey\Submission;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use Illuminate\Support\Facades\Log;

class SurveySynchupRepository extends BaseRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
       return Farmer_c::class;
    }


    public function create(array $alldata) : Farmer_c
    {
        $data = $alldata[0];
        $plot_c = $alldata[1];
        $diagnostic_data = $alldata[2];
        $observation_data = $alldata[3];
        $baseline_data = $alldata[4];
        $farm = $alldata[5];
        return DB::transaction(function () use ($data,$plot_c,$diagnostic_data,$observation_data,$baseline_data,$farm) {
            /*******CREATING SUBMISSION  DATA************/
            $submission = Submission::create($data);
            $data['submission_id']=$submission->id;
            $data['crop_id']=1;
            $data['country_admin_level_c_id']=2;
            /*******CREATING FARMER  DATA************/
            $farmer = parent::create($data);
            $data['farmer_id']=$farmer->id;
            $this->Data_Logs('Farmer  Data created successfully!!',$farmer);



            /*******CREATING FARMER BASE LINE  DATA************/
            if(!empty($baseline_data)) {
                $baseline_data['farmer_id'] = $farmer->id;
                $baseline_data['submission_id'] = $submission->id;
                $base = farmer_baseline_c::create($baseline_data);
                $this->Data_Logs('Farmer Baseline Data created successfully!!',$base);

            }

            /*******CREATING FARM  DATA************/
            if(!empty($farm)) {
                $farm = Farm_c::create($data);
                $this->Data_Logs('Farmer Farm Data created successfully!!',$farm);

            }
            if(!empty($plot_c)) {
       $this->plot_data_on_insertion($plot_c,$submission->id,$diagnostic_data,$farm->id,$observation_data);
                $this->Data_Logs('Farmer Plot Data created successfully!!',json_encode($plot_c));
            }
            return $farmer;
        });
      return 'failed';
    }


    public function updateById($id, array $alldata, array $options = [])
    {
        $data = $alldata[0];
        $plot_c = $alldata[1];
        $diagnostic_data = $alldata[2];
        $observation_data = $alldata[3];
        $baseline_data = $alldata[4];
        $farm = $alldata[5];

        return DB::transaction(function () use ($id, $data,$plot_c,$diagnostic_data,$observation_data,$baseline_data,$farm,$options) {

           $model = $this->getByColumn($id, 'external_id_c');
           $model->update($data, $options);
           $farmer = $model;
            $this->Data_Logs('Farmer Data updated successfully!!',$model);

            /*******CREATING FARMER BASE LINE  DATA************/

            if($this->surveydataExist(farmer_baseline_c::class,'farmer_id',$model->id) == 0) {
                if (!empty($baseline_data)) {
                    $baseline_data['farmer_id'] = $farmer->id;
                    $baseline_data['submission_id'] = $farmer->submission_id;
                    $base = farmer_baseline_c::create($baseline_data);
                    $this->Data_Logs('Farmer Baseline Data created successfully!!',$base);

                }
            }
            else{
                $model = $this->surveydataupdate(farmer_baseline_c::class,'farmer_id',$farmer->id);
               $base = $model->update($baseline_data);
                $this->Data_Logs('Farmer Baseline Data updated successfully!!',$model);

            }

            /*******CREATING FARM  DATA************/
            if($this->surveydataExist( Farm_c::class,'submission_id',$farmer->submission_id) == 0) {
                if(!empty($farm)) {
                    $data['farmer_id']=$farmer->id;
                    $data['submission_id'] = $farmer->submission_id;
                    $data['crop_id']=1;
                    $data['country_admin_level_c_id']=2;
                    $farm = Farm_c::create($data);
                    $model = $farm;
                    $this->Data_Logs('Farmer Farm Data created successfully!!',$farm);
                }
            }
            else{
                $model = $this->surveydataupdate( Farm_c::class,'submission_id',$farmer->submission_id);
                $model->update($data);
                $farm = $model;
                $this->Data_Logs('Farmer Farm Data updated successfully!!',$model);

            }

            foreach ($plot_c as $key => $value) {
                foreach ($value as $plot_data) {
                    if (SynchData::check_variable_data($plot_data['answer']) != 1) {
                        $plot[$plot_data['field_name']] = $plot_data['answer'];
                    }
                }
                $plot['farm_id'] =$model->id;
                $plot['submission_id'] = $farmer->submission_id;
               $external_id =  $plot['external_id_c'];
                    if ($this->surveydataExist(Plot_c::class, 'external_id_c', $external_id) == 0) {
                        if (!empty($plot_c)) {
                            $this->plot_data_on_update_insertion($plot, $farmer->submission_id, $diagnostic_data, $model->id, $observation_data,$key);
                        }
                }
                    else{
                        $this->plot_data_on_update($plot,$diagnostic_data,$observation_data,$key,$external_id);
                    }
            }
            return $model;
        });
    }


    /**
     * @param $name
     *
     * @return bool
     */
    public function surveyExist($uuid) : bool
    {
        return $this->model
                ->where('external_id_c', $uuid)
                ->count();
    }


    public function surveydataExist($objectname,$columnid,$uuid) : bool
    {
        return $objectname::where($columnid, $uuid)
            ->count();
    }

    public function surveydataupdate($objectname,$columnid,$uuid)
    {
        return $objectname::where($columnid, $uuid)
            ->first();
    }

    public function plot_data_on_insertion($plot_c,$submissionid,$diagnostic_data,$farmid,$observation_data){

        foreach ($plot_c as $key => $value) {
            foreach ($value as $plot_data) {
                if (SynchData::check_variable_data($plot_data['answer']) != 1) {
                    $plot[$plot_data['field_name']] = $plot_data['answer'];
                }
            }
            $plot['submission_id'] = $submissionid;
            $plot['farm_id'] = $farmid;
            $pl = Plot_c::create($plot);
            $this->Data_Logs('Farmer Plot Data created successfully!!',$pl);

            foreach ($diagnostic_data[$key] as $diag_data) {
                if (SynchData::check_variable_data($diag_data['answer']) != 1) {
                    $diagnstic[$diag_data['field_name']] = $diag_data['answer'];
                }
            }
            $diagnstic['plot_id'] = $pl->id;
            $diagnstic['submission_id'] = $submissionid;
            $diagnstic['external_id_c'] = $plot['external_id_c'];
            $diag = Diagnostic_monitoring_c::create($diagnstic);
            $this->Data_Logs('Farmer Diagnostic & Monitoring Data created successfully!!',$diag);

            foreach ($observation_data[$key] as $obser_data) {
                $observation['diagnostic_monitoring_id'] = $diag->id;
                $observation['submission_id'] = $submissionid;
                if(SynchData::check_variable_data($obser_data['answer']) != 1) {
                    $observation[$obser_data['field_name']] = $obser_data['answer'];
                }
                $observation['variable_c'] = $obser_data['variable_c'];
                $observation['result_c'] = '';
                $obser =observation_c::create($observation);
                $this->Data_Logs('Farmer Observation Data created successfully!!',$obser);
            }

        }
    }
    public function plot_data_on_update_insertion($plot,$submissionid,$diagnostic_data,$farmid,$observation_data,$key){
            $pl = Plot_c::create($plot);
        $this->Data_Logs('Farmer Plot Data created successfully!!',$pl);
            foreach ($diagnostic_data[$key] as $diag_data) {
                if (SynchData::check_variable_data($diag_data['answer']) != 1) {
                    $diagnstic[$diag_data['field_name']] = $diag_data['answer'];
                }
            }
            $diagnstic['plot_id'] = $pl->id;
            $diagnstic['submission_id'] = $submissionid;
            $diagnstic['external_id_c'] = $plot['external_id_c'];
            $diag = Diagnostic_monitoring_c::create($diagnstic);
        $this->Data_Logs('Farmer Diagnostic & Monitoring Data created successfully!!',$diag);
            foreach ($observation_data[$key] as $obser_data) {
                $observation['diagnostic_monitoring_id'] = $diag->id;
                $observation['submission_id'] = $submissionid;
                if(SynchData::check_variable_data($obser_data['answer']) != 1) {
                    $observation[$obser_data['field_name']] = $obser_data['answer'];
                }
                $observation['variable_c'] = $obser_data['variable_c'];
                $observation['result_c'] = '';
               $obser = observation_c::create($observation);
                $this->Data_Logs('Farmer Observation Data created successfully!!',$obser);
            }

        }



    public function plot_data_on_update($plot_c,$diagnostic_data,$observation_data,$key,$ext_id){
        $model = $this->surveydataupdate( Plot_c::class,'external_id_c', $ext_id);
        $model->update($plot_c);
        $this->Data_Logs('Farmer Plot Data update successfully!!',$model);
            foreach ($diagnostic_data[$key] as $diag_data) {
                if (SynchData::check_variable_data($diag_data['answer']) != 1) {
                    $diagnstic[$diag_data['field_name']] = $diag_data['answer'];
                }
            }
        $model = $this->surveydataupdate( Diagnostic_monitoring_c::class,'external_id_c',$ext_id);
            $model->update($diagnstic);
            $diag =$model;
        $this->Data_Logs('Farmer Diagnostic & Monitoring Data update successfully!!',$diag);
            foreach ($observation_data[$key] as $obser_data) {
                if(SynchData::check_variable_data($obser_data['answer']) != 1) {
                    $observation[$obser_data['field_name']] = $obser_data['answer'];
                }
                $observation['variable_c'] = $obser_data['variable_c'];
                $observation['result_c'] = '';
                $model = $this->surveydataupdate( observation_c::class,'variable_c',$observation['variable_c']);
                $model->update($observation);
                $obser = $model;
                $this->Data_Logs('Farmer Observation Data updated successfully!!',$obser);
            }

    }


    public function Data_Logs($text,$data){

        Log::info($text.' :'.$data);

    }


}
