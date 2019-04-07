<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 2/5/19
 * Time: 1:51 PM
 */

namespace App\Models\Auth\Traits\Relationship;
use App\Models\Auth\InputActivity;


Trait RecommendationActivityRelationship
{
    /**
     * @return mixed
     */
    public function InputActivity()
    {
        return $this->hasMany(InputActivity::class,'recommendation_activity_id','id');
    }
}
