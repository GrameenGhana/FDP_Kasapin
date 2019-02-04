<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 1/30/19
 * Time: 11:50 AM
 */

namespace App\Models\Auth\Traits\Relationship;


use App\Models\Auth\ActivityTranslation;

trait ActivityRelationship
{


    /**
     * @return mixed
     */
    public function ActivityTranslation()
    {
        return $this->hasMany(ActivityTranslation::class,'activity_id','id');
    }
}
