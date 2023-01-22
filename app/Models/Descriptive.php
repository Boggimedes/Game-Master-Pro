<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;


class Descriptive extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'text', 'world_id', 'gender', 'abilities','subtype','race_id','alive'
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

    public function world()
	{
		return $this->belongsTo(World::class);
	}


       

}
