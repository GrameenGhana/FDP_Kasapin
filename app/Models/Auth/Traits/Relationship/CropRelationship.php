<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 12/21/18
 * Time: 8:37 PM
 */

namespace App\Models\Auth\Traits\Relationship;


use App\Models\Auth\Input;
use App\Models\Auth\Recommendation;

trait CropRelationship
{

    /**
     * @return mixed
     */
    public function Recommendation()
    {
        return $this->hasMany(Recommendation::class,'crop_id','id');
    }

    /**
     * @return mixed
     */
    public function Input()
    {
        return $this->hasMany(Input::class,'crop_id','id');
    }



    /**
     * @return mixed
     */
    public function Activity()
    {
        return $this->hasMany(Activity::class,'activity_id','id');
    }


}
