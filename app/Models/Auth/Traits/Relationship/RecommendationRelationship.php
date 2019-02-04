<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 1/15/19
 * Time: 4:17 PM
 */

namespace App\Models\Auth\Traits\Relationship;


use App\Models\Auth\RecommendationActivity;
use App\Models\Auth\RecommendationCalculation;

trait RecommendationRelationship
{

    /**
     * @return mixed
     */
    public function  calculations()
    {
        return $this->hasMany(RecommendationCalculation::class,'recommendation_id','id');
    }

    /**
     * @return mixed
     */
    public function activity()
    {
        return $this->hasMany(RecommendationActivity::class,'recommendation_id','id');
    }


}
