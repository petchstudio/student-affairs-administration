<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The table containing the activities category.
     *
     * @var string
     */
    protected $table = 'news';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'date',
        'author',
    ];
}
