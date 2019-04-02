<?php

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class Farm_c extends Model
{
    protected $fillable = [
        'farmer_id','submission_id', 'crop_id','country_admin_level_c_id',
        'gps_lat_c','gps_long_c', 'year_of_establishment_c','name_c'
    ];


    protected $hidden = [

    ];

    protected $table = 'farm_c';

}
