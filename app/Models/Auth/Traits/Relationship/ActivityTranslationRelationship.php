<?php
/**
 * Created by PhpStorm.
 * User: spomega
 * Date: 1/30/19
 * Time: 11:49 AM
 */

namespace App\Models\Auth\Traits\Relationship;

use App\Models\Auth\Activity;


trait ActivityTranslationRelationship
{

    /**
     * @return mixed
     */
    public function Activity()
    {
        return $this->BelongsTo(Activity::class,'activity_id');
    }



}
