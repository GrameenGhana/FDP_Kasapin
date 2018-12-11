<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 11/2/18
 * Time: 10:34 AM
 */

namespace App\Repositories\Backend\Auth;



use App\Models\Auth\Country;
use App\Models\Auth\CountryAdminLevel;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

class CountryAdminLevelRepository extends  BaseRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return CountryAdminLevel::class;
    }


    /**
     * @param array $data
     *
     * @return  CountryAdminLevel
     * @throws GeneralException
     */
    public function create(array $data) : CountryAdminLevel
    {


        // Make sure it doesn't already exist

        if ($this->adminLevelExists($data['name'])) {
            throw new GeneralException('A level already exists with the name '.$data['name']);
        }


        return DB::transaction(function () use ($data) {
            $parent_id = 0;
           // dd($data['parent']);
            if($data['parent'] == 'none'){
                $parent_id = 0;
            }
            else{
               $parent_id = (int)$data['parent'];
            }

            $type = Country::findOrFail((int)$data['country_id'])->countryAdmin()->where('level',(int)$data['admin_level_1'])->first();



           $level = parent::create(['name' => strtolower($data['name']),'country_id'=>(int)$data['country_id'],
                'parent_id'=>$parent_id,
                'type'=>$type->name
                ]);

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
