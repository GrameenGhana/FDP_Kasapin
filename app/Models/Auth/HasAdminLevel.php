<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class HasAdminLevel extends Model
{
    //
    /**
     * The table associated with the country model.
     *
     * @var string
     */

    protected $table = 'country_has_admin_level_c';

    protected  $fillable = ['name','country_id'];
}
