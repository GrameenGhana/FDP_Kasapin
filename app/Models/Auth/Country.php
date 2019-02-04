<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Attribute\CountryAttribute;
use App\Models\Auth\Traits\Method\CountryMethod;
use App\Models\Auth\Traits\Relationship\CountryRelationship;
use Illuminate\Database\Eloquent\Model;


class Country extends Model
{
    /**
     * The table associated with the country model.
     *
     * @var string
     */

    protected $table = 'country_c';

    protected  $fillable = ['name','currency','iso_code','avg_gate_price','admin_level'];

    use CountryAttribute,CountryMethod,CountryRelationship;



}
