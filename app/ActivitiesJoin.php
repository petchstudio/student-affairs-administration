<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivitiesJoin extends Model
{
    /**
     * The table containing the activities category.
     *
     * @var string
     */
    protected $table = 'activities_join';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'student_id',
        'activities_id',
        'status',
    ];
}
