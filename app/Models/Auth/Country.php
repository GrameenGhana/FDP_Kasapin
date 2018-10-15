<?php

namespace App\Models\Auth;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * The table associated with the country model.
     *
     * @var string
     */

    protected $table = 'country_c';

    protected  $fillable = ['name','currency','iso_code'];
}
