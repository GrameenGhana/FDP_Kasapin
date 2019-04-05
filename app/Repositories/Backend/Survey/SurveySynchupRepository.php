<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/8/18
 * Time: 11:42 AM
 */

namespace App\Repositories\Backend\Survey;

use App\Helpers\Auth\Auth;
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
        return DB::transaction(function () use ($data,$plot_c,$diagnostic_data,$observation_data,$baseline_data) {
            /*******CREATING SUBMISSION  DATA************/
            $submission = Submission::create($data);
            $data['submission_id']=$submission->id;
            $data['crop_id']=1;
            $data['country_admin_level_c_id']=2;
            /*******CREATING FARMER  DATA************/
            $farmer = parent::create($data);
            $data['farmer_id']=$farmer->id;


            /*******CREATING FARMER BASE LINE  DATA************/

            $baseline_data['farmer_id']=$farmer->id;
            $baseline_data['submission_id']=$submission->id;
            farmer_baseline_c::create($baseline_data);

            /*******CREATING FARM  DATA************/
            $farm = Farm_c::create($data);


            foreach ($plot_c as $key =>  $value) {
                foreach ($value as $plot_data){
                    $plot[$plot_data['field_name']] = $plot_data['answer'];
                }
                $plot['submission_id']=$submission->id;
                $plot['farm_id']=$farm->id;
                 $pl = Plot_c::create($plot);

                foreach ($diagnostic_data[$key] as $diag_data){
                    $diagnstic[$diag_data['field_name']] = $diag_data['answer'];
                }
                $diagnstic['plot_id']=$pl->id;
                $diagnstic['submission_id']=$submission->id;
                $diagnstic['external_id_c'] = $plot['external_id_c'];
                $diag = Diagnostic_monitoring_c::create($diagnstic);

                foreach ($observation_data[$key] as $obser_data){
                    $observation['diagnostic_monitoring_id']=$diag->id;
                    $observation['submission_id']=$submission->id;
                    $observation[$obser_data['field_name']] = $obser_data['answer'];
                    $observation['variable_c'] = $obser_data['variable_c'];
                    $observation['result_c'] = '';
                    observation_c::create($observation);
                }

            }

            return $farmer;
        });
      return 'failed';
    }


    public function updateById($id, array $data, array $options = [])
    {


        return DB::transaction(function () use ($id, $data,$options) {

           $model = $this->getByColumn($id, 'external_id_c');
            $model->update($data, $options);
            return $model;
           // throw new GeneralException(trans('exceptions.backend.survey.forms.update_error'));
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

}
