<?php

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class observation_c extends Model
{
    protected $fillable = [
        'diagnostic_monitoring_id','submission_id', 'competence_c',
        'reason_for_failure_c','observation_c','result_c','variable_c'
    ];

    protected $hidden = [

    ];

    protected $table = 'observation_c';
}
