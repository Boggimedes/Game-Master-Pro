<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;


class Sound extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'ext',
        'tags',
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

    protected $appends = [
        'filename'
    ];


    public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function getFilenameAttribute() {
        return "https://game-master-pro.s3.us-west-2.amazonaws.com/sounds/" . $this->user_id . "/" . $this->id . "." . $this->ext;
    }

}
