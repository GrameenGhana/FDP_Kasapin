<?php

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class Farmer_c extends Model
{
    protected $fillable = [
        'submission_id','country_admin_level_id',
        'age_c','birthday_c','educational_level_c',
        'external_id_c','farmer_code_c','farmer_group_c',
        'farmer_photo_c','full_name_c','gender_c',
        'household_address_c','household_gps_lat_c',
        'household_gps_long_c','phone_number_c',
        'reason_retreat_c','registration_date_c',
        'year_start_relationship_c','status_c'
    ];


    protected $hidden = [

    ];

    protected $table = 'farmer_c';

}
