<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/8/18
 * Time: 11:42 AM
 */

namespace App\Repositories\Backend\Survey;

use App\Helpers\Auth\Auth;
use App\Models\Survey\Farmer_c;
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


    public function create(array $data) : Farmer_c
    {
        return DB::transaction(function () use ($data) {
            $submission = Submission::create($data);
            $data['submission_id']=$submission->id;
            $farmer = parent::create($data);

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
