<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 11/29/18
 * Time: 1:21 PM
 */

namespace App\Models\Survey\Traits\Relationship;


use App\Models\Survey\Question;
use App\Models\Survey\Form;

trait SkipLogicRelationship
{

    /**
     * @return
     *
     */
    public function  question()
    {
               return $this->belongsTo(Question::class,'question_id');
    }




}
