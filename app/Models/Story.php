<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    public $timestamps = false;
    use HasFactory;
    protected $fillable = [
        'name',
        'region_id',
        'chapters',
        'tags'
    ];
    protected $casts = [
        'chapters' => 'array',
        'tags' => 'array',
    ];

    public function region()
	{
		return $this->belongsTo(Region::class);
	}
	public function npc()
	{
            return $this->belongsToMany(\App\Models\Npc::class,
			'story_npc',
			'story_id',
			'npc_id',
			'id');
	}
	public function poi()
	{
            return $this->belongsToMany(\App\Models\POI::class,
			'story_poi',
			'story_id',
			'poi_id',
			'id');
	}
}
