<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 11/29/18
 * Time: 1:21 PM
 */

namespace App\Models\Auth\Traits\Relationship;


use App\Models\Auth\Question;
use App\Models\Auth\Form;

trait FormTranslationRelationship
{

    /**
     * @return mixed
     */
    public function question()
    {
        return $this->hasMany(Question::class,'form_translation_id','id');
    }

    /**
     * @return
     *
     */
    public function  form()
    {
               return $this->belongsTo(Form::class,'form_id');
    }



    }
