<?php

namespace App\Models\Survey;

use App\Models\Survey\Traits\Attribute\FormAttribute;
use App\Models\Survey\Traits\Attribute\SkipLogicAttribute;
use App\Models\Survey\Traits\Relationship\FormRelationship;
use App\Models\Survey\Traits\Relationship\SkipLogicRelationship;
use Illuminate\Database\Eloquent\Model;

class SkipLogic extends Model
{

    /**
     * The table associated with the form model.
     *
     * @var string
     */

    protected $table = 'skip_logic_c';

    protected  $fillable = ['question_id','hide_c','formula_c','user_id'];

    use SkipLogicAttribute;
    use SkipLogicRelationship;

}
