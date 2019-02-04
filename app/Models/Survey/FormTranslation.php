<?php

namespace App\Models\Survey;

use App\Models\Survey\Traits\Relationship\FormTranslationRelationship;
use Illuminate\Database\Eloquent\Model;

class FormTranslation extends Model
{
    //
    /**
     * The table associated with the form_translation_c model.
     *
     * @var string
     */

    protected $table = 'form_translation_c';

    use FormTranslationRelationship;

    protected  $fillable = ['form_id','country_id','display_name_c','user_id'];


}
