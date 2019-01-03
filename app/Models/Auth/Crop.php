<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Relationship\CropRelationship;
use Illuminate\Database\Eloquent\Model;

class Crop extends Model
{
    //
    /**
     * The table associated with the crop model.
     *
     * @var string
     */

    protected $table = 'crop_c';

    use CropRelationship;
}
