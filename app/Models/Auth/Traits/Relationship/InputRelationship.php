<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 2/5/19
 * Time: 10:40 AM
 */

namespace App\Models\Auth\Traits\Relationship;


use App\Models\Auth\InputActivity;

trait InputRelationship
{
    /**
     * @return mixed
     */
    public function InputActivity()
    {
        return $this->hasMany(InputActivity::class,'input_id','id');
    }

}
