<?php

namespace App\Models\Survey;

use App\Models\Survey\Traits\Attribute\QuestionAttribute;
use App\Models\Survey\Traits\Relationship\QuestionRelationship;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    /**
     * The table associated with the country model.
     *
     * @var string
     */

    protected $table = 'question_c';

    protected  $fillable = ['label_c','caption_c','type_c','required_c','formula_c','default_value_c','display_order_c',
        'help_text_c','hide_c','options_c','form_translation_id','user_id'];

    use QuestionAttribute,QuestionRelationship;

}
