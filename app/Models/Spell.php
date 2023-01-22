<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;


class Spell extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'damage',
        'fulltext',
        'shorttext',
        'range',
        'level',
        'school',
        'save',
        'casttime',
        'components',
        'attack',
        'user_id',
];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
    ];


    public function user()
	{
		return $this->belongsTo(User::class);
	}

}
