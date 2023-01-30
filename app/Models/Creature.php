<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use App\Traits\SecureUpdatable;

class Creature extends Model
{
    use SecureUpdatable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'page',
        'challenge_rating',
        'speed',
        'armor_class',
        'armor_class_notes',
        'challenge_rating',
        'hit_points',
        'desc',
        'sounds',
        'vol',
        'initiative',
        'str',
        'dex',
        'con',
        'int',
        'wis',
        'cha',
        'str_save',
        'dex_save',
        'con_save',
        'int_save',
        'wis_save',
        'cha_save',
        'senses',
        'special',
        'environment',
        'skills',
        'attacks',
        'multiattacks',
        'size',
        'legendary',
        'legendary_actions',
        'image',
        'user_id',
];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    ];

    protected $appends = ['multiattacks','attacks'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'skills' => 'array',
        'old_attacks' => 'array',
        'old_multiattacks' => 'array',
        'legendary_actions' => 'array',
        'spellcasting' => 'object',
    ];


    public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function actions() {
        return $this->hasMany(Action::class);
    }

    public function getMultiattacksAttribute() {
        return $this->actions()->where('type', 'multiattack')->get();
    }

    public function getAttacksAttribute() {
        return $this->actions()->where('type', 'attack')->get();
    }

}
