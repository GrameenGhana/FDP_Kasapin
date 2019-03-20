<?php

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'respondent_id','surveyor_id','start_date_c','end_date_c',
        'status'
    ];


    protected $hidden = [

    ];

    protected $table = 'submission_c';


}
