<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sdu_id',
        'email',
        'password',
        'type',
        'avatar',
        'firstname',
        'lastname',
        'advisor',
        'section',
        'address',
        'tel',
        'tel_parent',
        'birth_date',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function isAdmin($id)
    {
        $user = User::find($id);
        
        return strcmp($user->type, 'admin') == 0;
    }

    public static function isTeacher($id)
    {
        $user = User::find($id);
        
        return strcmp($user->type, 'teacher') == 0;
    }

    public static function isStudent($id)
    {
        $user = User::find($id);
        
        return strcmp($user->type, 'student') == 0;
    }

    public static function getType($type)
    {
        $types = [
            'admin' => 'ผู้ดูแลระบบ',
            'teacher' => 'อาจารย์',
            'student' => 'นักศึกษา',
        ];
        
        return $types[$type];
    }
}
