<?php


namespace App\Models\Auth;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Auth\Traits\Relationship\RecommendationActivityRelationship;

class RecommendationActivity extends Model
{
    //
    /**
     * The table associated with the recommendation_activity model.
     *
     * @var string
     */

    protected $table = 'recommendation_activity_c';
    use RecommendationActivityRelationship;
}
