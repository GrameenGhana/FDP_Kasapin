<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/29/18
 * Time: 11:54 AM
 */

namespace App\Models\Auth\Traits\Relationship;

use App\Models\Auth\ActivityTranslation;
use App\Models\Survey\FormAssignation;
use App\Models\Auth\HasAdminLevel;
use App\Models\Survey\FormTranslation;
use App\Models\Auth\Recommendation;

trait CountryRelationship
{

    /**
     * @return mixed
     */
    public function countryAdmin()
    {
       return $this->hasMany(HasAdminLevel::class,'country_id','id');
    }

    /**
     * @return mixed
     */
    public function formAssignation()
    {
        return $this->hasMany(FormAssignation::class,'country_id','id');
    }


    /**
     * @return mixed
     */
    public function formTranslation()
    {
        return $this->hasMany(FormTranslation::class,'country_id','id');
    }

    /**
     * @return mixed
     */
    public function Recommendation()
    {
        return $this->hasMany(Recommendation::class,'country_id','id');
    }

    /**
     * @return mixed
     */
    public function ActivityTranslation()
    {
        return $this->hasMany(ActivityTranslation::class,'country_id','id');
    }


}
