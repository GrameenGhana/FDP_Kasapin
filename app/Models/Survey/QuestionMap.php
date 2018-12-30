<?php
/**
 * Created by PhpStorm.
 * User: liman
 * Date: 30/12/2018
 * Time: 1:33 PM
 */

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Model;

class QuestionMap extends Model
{
    //
    /**
     * The table associated with the question map model.
     *
     * @var string
     */

    protected $table = 'map_c';

    protected  $fillable = ['question_id','object_c','field_c'];


}