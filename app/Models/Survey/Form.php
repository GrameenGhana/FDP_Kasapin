<?php

namespace App\Models\Survey;

use App\Models\Survey\Traits\Attribute\FormAttribute;
use App\Models\Survey\Traits\Relationship\FormRelationship;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{

    /**
     * The table associated with the form model.
     *
     * @var string
     */

    protected $table = 'form_c';

    protected  $fillable = ['form_name_c','display_order_c','type_c','display_type_c','custom_c','user_id'];

    use FormAttribute;
    use FormRelationship;



}
