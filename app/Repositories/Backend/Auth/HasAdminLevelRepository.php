<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/15/18
 * Time: 10:29 AM
 */

namespace App\Repositories\Backend\Auth;


use App\Models\Auth\HasAdminLevel;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

class HasAdminLevelRepository extends BaseRepository
{
    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return HasAdminLevel::class;
    }


    /**
     * @param array $data
     *
     * @return  HasAdminLevel
     * @throws GeneralException
     */
    public function create(array $data) : HasAdminLevel
    {


        // Make sure it doesn't already exist
        /*
        if ($this->adminLevelExists($data['name'])) {
            throw new GeneralException('A level already exists with the name '.$data['name']);
        }
              */

        return DB::transaction(function () use ($data) {
            $level = parent::create(['name' => strtolower($data['name']),'country_id'=>(int)$data['country_id'],'level'=>$data['level']]);

            if($level) {
                return $level;
                //add level created event  here
            }

            throw new GeneralException(trans('exceptions.backend.access.countries.create_error'));
        });
    }


    /**
     * @param $name
     *
     * @return bool
     */
    protected function adminLevelExists($name) : bool
    {
        return $this->model
                ->where('name', strtolower($name))
                ->count() > 0;
    }

}
