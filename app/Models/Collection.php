<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;


class Collection extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'desc',
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

	public function scenes()
	{
            return $this->belongsToMany(\App\Models\Scene::class,
			'collection_scene',
			'collection_id',
			'scene_id',
			'id')->withPivot('order')->orderBy('collection_scene.order');
	}

}