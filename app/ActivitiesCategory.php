<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivitiesCategory extends Model
{
    /**
     * The table containing the activities category.
     *
     * @var string
     */
    protected $table = 'activities_category';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public static function getCategoryName($id)
    {
        $category = ActivitiesCategory::find($id);
        
        return $category->name;
    }
}
