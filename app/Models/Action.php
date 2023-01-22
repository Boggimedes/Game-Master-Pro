<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $casts = [
        'attacks' => 'array',
    ];

    public function creature() {
		return $this->belongsTo(Creature::class);
    }
}
