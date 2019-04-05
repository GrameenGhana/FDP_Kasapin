<?php

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class Diagnostic_monitoring_c extends Model
{
    protected $fillable = [
        'plot_id','submission_id', 'recommendation_id','date_c',
        'agreed_on_recommendations_c','drainnage_need_c',
        'estimated_production_c','external_id_c','farm_assessment_c'
        ,'farm_condition_c','filling_in_option_c','gaps_c','genetic_plant_material_c',
        'hire_labor_c','lime_need_c','ph_c','plot_assessment_c','reason_not_agreement_c',
        'soil_fertility_management_c','start_year_c','thinning_out_option_c',
        'type_c','comments_c','renovated_c','renovated_correctly_c',
        'renovated_intervention_c','renovated_made_c'
    ];

    protected $hidden = [

    ];

    protected $table = 'diagnostic_monitoring_c';
}
