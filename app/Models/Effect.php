<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;


class Effect extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'desc',
        'volume',
        'pre_delay',
        'loop',
        'delay_min',
        'delay_max',
        'optional',
        'seq',
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
        'sounds' => 'array'
    ];


    public function user()
	{
		return $this->belongsTo(User::class);
	}
    public function sounds()
    {
        return $this->hasMany(Sound::class);
    }
}
