<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    /**
     * The table containing the activities category.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'term',
        'year',
        'generation',
        'section',
        'event_at',
    ];

    public static function canJoin($activities, $user)
    {
        return (
            strcmp($activities->generation, '0') == 0
            ||
            strpos($user->sdu_id, $activities->generation) === 0
        )
        &&
        (
            strcmp($activities->section, '0') == 0
            ||
            strcmp(strtoupper($activities->section), strtolower($user->section)) == 0
        );
    }
}
