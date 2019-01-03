<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 12/27/18
 * Time: 1:41 PM
 */

namespace App\Models\Auth\Traits\Relationship;
use App\Models\Auth\SkipLogic;

class QuestionRelationship
{

    /**
     * @return mixed
     */
    public function SkipLogic()
    {
        return $this->hasMany(SkipLogic::class,'question_id','id');

    }




}
