<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 10/29/18
 * Time: 11:54 AM
 */

namespace App\Models\Auth\Traits\Relationship;

use App\Models\Auth\HasAdminLevel;

trait CountryRelationship
{

    /**
     * @return mixed
     */
    public function countryAdmin()
    {
       return $this->hasMany(HasAdminLevel::class,'country_id','id');
    }
}
