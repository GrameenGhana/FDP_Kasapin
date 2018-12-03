<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Relationship\FormTranslationRelationship;
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

}
