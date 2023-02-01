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
        'effect_id',
        'fade_out',
        'fade_in',
        'chance',
        'pitch_var',
        'pitch_set',
        'vol',
        'chance',
        'name',
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

    protected $appends = ['file'
    ];

    public function getFilenameAttribute() {
        // return "https://game-master-pro.s3.us-west-2.amazonaws.com/sounds/" . $this->user_id . "/" . $this->id . "." . $this->ext;
    }

    public function getFileAttribute() {
        return $this->soundFile->name . '.' . $this->soundFile->ext;
    }
    
    
    public function SoundFile() {
        return $this->hasOne(SoundFile::class,'id','sound_file_id');
    }

}
