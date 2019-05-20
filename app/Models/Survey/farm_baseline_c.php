<?php
namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class farm_baseline_c extends Model
{

    protected $fillable = [
        'farm_id','submission_id', 'aditional_crops_c',
        'area_units_c','have_aditional_crops_c',
        'average_main_crop_price_c','hire_labor_c',
        'measure_units_c','number_of_plots_c',
        'total_area_other_crops_c','total_main_crop_area_c','total_land_under_cultivation_c'
        ,'production_main_crop_last_year_c','total_farm_area_c','total_renovation_area_c',
        'farm_certifications_c','total_farm_area_ha_c','total_renovation_area_ha_c','production_main_crop_last_year_kg_c',
        'total_area_other_crops_ha_c','total_main_crop_area_ha_c','total_land_under_cultivation_ha_c',
        'farm_map_c','labour_type_c'
    ];

    protected $hidden = [

    ];

    protected $table = 'farm_baseline_c';

}
