<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/8/18
 * Time: 11:42 AM
 */

namespace App\Repositories\Backend\Auth;


use App\Models\Auth\Country;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

class CountryRepository extends BaseRepository
{

    /**
     * Specify Model class name.
     *
     * @return mixed
     */
    public function model()
    {
       return Country::class;
    }


    /**
     * @param array $data
     *
     * @return Country
     * @throws GeneralException
     */
    public function create(array $data) : Country
    {
        // Make sure it doesn't already exist
        if ($this->countryExists($data['name'])) {
            throw new GeneralException('A country already exists with the name '.$data['name']);
        }


        return DB::transaction(function () use ($data) {
            $country = parent::create(['name' => $data['name'],"avg_gate_price" =>(double)$data["avg_gate_price"],
                "currency"=> strtoupper($data['currency']),'iso_code'=>  strtoupper($data['iso_code']),'admin_level' => (int)$data['admin_level']]);


            if($country)
            {
                return $country;
                //add country created event  here
            }

            throw new GeneralException(trans('exceptions.backend.access.countries.create_error'));
        });
    }

    /**
     * @param Permission  $permission
     * @param array $data
     *
     * @return mixed
     * @throws GeneralException
     */
    public function update(Country $country, array $data)
    {


        // If the name is changing make sure it doesn't already exist
        if ($country->name !== $data['name']) {
            if ($this->countryExists($data['name'])) {
                throw new GeneralException('A Country already exists with the name '.$data['name']);
            }
        }


        return DB::transaction(function () use ($country, $data) {
            if ($country->update([
                'name' => $data['name'],
                "avg_gate_price" =>(double)$data["avg_gate_price"],
                "currency"=> strtoupper($data['currency']),'iso_code'=>  strtoupper($data['iso_code']),
            ])) {

                // event(new RoleUpdated($permission));

                return $country;
            }

            throw new GeneralException(trans('exceptions.backend.access.permissions.update_error'));
        });
    }



    /**
     * @param $name
     *
     * @return bool
     */
    protected function countryExists($name) : bool
    {
        return $this->model
                ->where('name', $name)
                ->count() > 0;
    }

}
