<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 11/29/18
 * Time: 1:21 PM
 */

namespace App\Models\Survey\Traits\Relationship;

use App\Models\Survey\QuestionMap;

trait QuestionRelationship
{


    /**
     * @return
     *
     */
    public function  map()
    {
               return $this->hasOne(QuestionMap::class,'question_id','id');
    }


}
