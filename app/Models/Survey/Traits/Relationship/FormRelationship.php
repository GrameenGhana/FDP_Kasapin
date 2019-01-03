<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 11/29/18
 * Time: 1:21 PM
 */

namespace App\Models\Survey\Traits\Relationship;


use App\Models\Survey\FormTranslation;

trait FormRelationship
{


    /**
     * @return
     *
     */
    public function  form_translation()
    {
               return $this->hasOne(FormTranslation::class,'form_id','id');
    }


}
