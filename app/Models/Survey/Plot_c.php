<?php

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class Plot_c extends Model
{
    protected $fillable = [
        'farm_id','submission_id','estimated_production_c','estimated_production_kg_c',
        'external_id_c','age_c','area_c','area_ha_c','gps_lat_c',
        'gps_long_c','name_c','description_c'];


    protected $hidden = [

    ];

    protected $table = 'plot_c';


}
