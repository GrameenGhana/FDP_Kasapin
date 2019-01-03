<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/8/18
 * Time: 11:42 AM
 */

namespace App\Repositories\Backend\Survey;

use App\Helpers\Auth\Auth;
use App\Models\Survey\SkipLogic;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

class SkipLogicRepository extends BaseRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
       return SkipLogic::class;
    }


    /**
     * @param array $data
     *
     * @return SkipLogic
     * @throws GeneralException
     */
    public function create(array $data) : SkipLogic
    {
        // Make sure it doesn't already exist
        if ($this->skiplogicExists($data['question_id'])) {
            throw new GeneralException('A skiplogic already exists with the name '.$data['question_id']);
        }



        return DB::transaction(function () use ($data) {
            $skiplogic = parent::create([
                'question_id' => $data['question_id'],
                'hide_c' => $data["hide_c"],
                'formula_c'=> $data['formula_c'],
                'user_id' => \auth()->user()->id
            ]);


            if($skiplogic)
            {

                return $skiplogic;
            }

            throw new GeneralException(trans('exceptions.backend.survey.skiplogics.create_error'));
        });
    }

    /**
     * @param Permission  $permission
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(SkipLogic $skiplogic, array $data)
    {


        // If the name is changing make sure it doesn't already exist
        if ($skiplogic->skiplogic_name_c !== $data['question_id']) {
            if ($this->skiplogicExists($data['question_id'])) {
                throw new GeneralException('A SkipLogic already exists with the name '.$data['question_id']);
            }
        }


        return DB::transaction(function () use ($skiplogic, $data) {
            if ($skiplogic->update([
                'question_id' => $data['question_id'],
                'hide_c' => $data["hide_c"],
                'formula_c'=> $data['formula_c'],

            ])) {

                // event(new RoleUpdated($permission));

                return $skiplogic;
            }

            throw new GeneralException(trans('exceptions.backend.survey.skiplogics.update_error'));
        });
    }



    /**
     * @param $name
     *
     * @return bool
     */
    protected function skiplogicExists($name) : bool
    {
        return $this->model
                ->where('question_id', $name)
                ->count() > 0;
    }

}
