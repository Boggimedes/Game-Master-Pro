<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;


class Race extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'plural',
        'adjective',
        'adulthood',
        'middle_age',
        'old_age',
        'venerable',
        'max_age',
        'friend_rate',
        'enemy_rate',
        'genders',
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
        'genders' => 'array',
    ];


    public function world()
	{
		return $this->belongsTo(World::class);
	}

    public function getBirthGenderAttribute()
    {
        return key($this->genders[0]);
    }

    public function getOtherGenderAttribute()
    {
        if (count($this->genders) == 1) {
            return key($this->genders[0]);
        } else return key($this->genders[mt_rand(1, count($this->genders) - 1)]);
    }
  
    public function generateName()
    {
        if ($name->count() > 0) {
            return $names->random(1);
        } else return "Npc" . $this->id;

    }

    public function deathChance($age) {
        $p = round(($age*100) / $this->max_age);
        $y = .1 * $this->adulthood;
        if ($p <= 2) return 15/$y;
        if ($age <= $this->adulthood) return 5/$this->adulthood;
        if ($age <= $this->middle_age) return 10/($this->middle_age - $this->adulthood);
        if ($age <= $this->old_age) return 10/($this->old_age - $this->middle_age);
        if ($age <= $this->venerable) return 80/($this->venerable - $this->old_age);
        if ($age <= $this->max_age) return 100/($this->max_age - $this->venerable);
        return 50;
    }

    // public function deathChance($age) {
    //         $a=2.2765E-06;
    //         $b=-0.00040584;
    //         $c=0.022322;
    //         $d=-0.37058;
    //         $f=1.377;
    //         $x = $this->max_age / $age;
    //         return $deathChance = max($a*pow($x,4) + $b*pow($x,3) + $c*pow($x,2) + $d*$x + $f,0.1)*10;
    // }
    
}
