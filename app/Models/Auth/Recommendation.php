<?php

namespace App\Models\Auth;

use App\Models\Auth\Traits\Relationship\RecommendationRelationship;
use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    //
    /**
     * The table associated with the recommendation model.
     *
     * @var string
     */

    protected $table = 'recommendation_c';

    use RecommendationRelationship;
}
