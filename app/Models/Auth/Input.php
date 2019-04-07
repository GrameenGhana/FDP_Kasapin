<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;
use App\Models\Auth\Traits\Relationship\InputRelationship;

class Input extends Model
{
    //

    /**
     * The table associated with the input model.
     *
     * @var string
     */

    protected $table = 'input_c';

   use InputRelationship;
}
