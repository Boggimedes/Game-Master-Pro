<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \App\Models\Helpers\NameGenerator\Generator;


class Npc extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'gender',
        'profession_id',
        'alive',
        'married',
        'race_id',
        'spouse_id',
        'birth_parent_id',
        'parent_id',
        'region_id',
        'age',
        'birth_year',
        'generation',
        'abilities',
        'features',
        'notes',
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
        'features' => 'array',
        'events' => 'array',
    ];
    
    public function user()
	{
		return $this->belongsTo(User::class);
	}

    public function profession()
	{
		return $this->belongsTo(Profession::class);
	}

    public function race()
	{
		return $this->belongsTo(Race::class);
	}

    public function region()
	{
		return $this->belongsTo(Region::class);
	}

    public function spouse()
	{
		return $this->belongsTo(Npc::class);
	}

    public function parent()
	{
		return $this->belongsTo(Npc::class);
	}

    public function birthParent()
	{
		return $this->belongsTo(Npc::class);
	}

  public function children()
  {
      return Npc::where(function($q) {
          $q->where('birth_parent_id',$this->id)
              ->orWhere('parent_id',$this->id);
      });
  }
  
  public function getChildrenAttribute()
  {
      return $this->children()->get();
  }

  public function generateName() 
  {
      $genString = 'fantasy';
      foreach($this->race->genders as $gender) {
          if (key($gender) == $this->gender) $genString = current($gender);
      }
      $g = New Generator($genString);
      $this->name =  $g->toString();
      $this->save();
  }

  public function isBirthing()
  {

      return key($this->race->genders[0]) == $this->gender;
  }
  public function isRelated(Npc $npc)
  {
      return in_array($npc->id, $this->family->toArray());
  }
  public function getFamilyAttribute()
  {
      $relatives = collect();
      if ($this->birthingParent && $this->birthingParent->children) $relatives->merge($this->birthingParent->children->pluck('id'));
      if ($this->parent && $this->parent->children) $relatives->merge($this->parent->children->pluck('id'));
      if ($this->children) $relatives->merge($this->children->pluck('id'));
      $relatives->merge(
          [$this->birth_parent_id],
          [$this->parent_id],
      );
      return $relatives;
  }

  public function getLineageAttribute()
  {
      $features = collect($this->features);
      if (!$features->has('lineage')) return "";
      return $features['lineage'];
  }

  public function getLineageNameAttribute()
  {
      $features = collect($this->features);
      if (!$features->has('lineage')) return "";
      $lineage = $features['lineage']['text'];
      return str_replace(['Immortal (',')'],['', ''], $lineage);
  }

  public function setLineageAttribute($value)
  {
      $features = collect($this->features);
      $features['lineage'] = ['name' => 'lineage', 'text' => $value];
      $this->features = $features->values();
  }

  public function setMannerismAttribute($value)
  {
      $features = collect($this->features);
      $features['mannerism'] = ['name' => 'mannerism', 'text' => $value];
      $this->features = $features->values();
  }

  public function getMannerismAttribute()
  {
      $features = collect($this->features);
      if (!$features->has('mannerism')) return "";
      return $features['mannerism'];
  }

  public function setQuirkAttribute($value)
  {
      $features = collect($this->features);
      $features['quirk'] = ['name' => 'quirk', 'text' => $value];
      $this->features = $features->values();
  }

  public function getQuirkAttribute()
  {
      $features = collect($this->features);
      if (!$features->has('quirk')) return "";
      return $features['quirk'];
  }

  public function getMarryAgeAttribute() {
      return $this->race->adulthood - $this->race->middle_age/12;
  }

  public function getAgeGroupAttribute() {
      if ($this->age < $this->race->adulthood) return 'youth';
      if ($this->age < $this->race->middle_age) return 'adult';
      if ($this->age < $this->race->old_age) return 'middle age';
      if ($this->age < $this->race->venerable) return 'old age';
      return 'venerable';
  }
  public function addEvent($event) {
      $events = $this->events;
      $events[] = $event;
      $this->events = $events;
      return $this;
  }
  /* Calculate relationship "a is the ___ of b" */
  static function calculateRelationship($npcA, $npcB)
  {
      \Log::info('npcA');
      \Log::info($npcA);
      \Log::info('npcB');
      \Log::info($npcB);
    if ($npcA['id'] == $npcB['id']) {
      return 'self';
    }

    $lca = self::lowest_common_ancestor($npcA, $npcB);
    if (!$lca) {
      return false;
    }
    $a_dist = $lca[1];
    $b_dist = $lca[2];


    // DIRECT DESCENDANT - PARENT
    if ($a_dist == 0) {
      $rel = $npcA['gender'] == 'Male' ? 'father' : 'mother';
      return self::aggrandize_relationship($rel, $b_dist);
    }
    // DIRECT DESCENDANT - CHILD
    if ($b_dist == 0) {
      $rel = $npcA['gender'] == 'Male' ? 'son' : 'daughter';
      return self::aggrandize_relationship($rel, $a_dist);
    }

    // EQUAL DISTANCE - SIBLINGS / PERFECT COUSINS
    if ($a_dist == $b_dist) {
      switch ($a_dist) {
        case 1:
          return $npcA['gender'] == 'Male' ? 'brother' : 'sister';
          break;
        case 2:
        case 3:
          return 'cousin';
          break;
        default:
          return 'distant cousin';
      }
    }

    // AUNT / UNCLE
    if ($a_dist == 1) {
      $rel = $npcA['gender'] == 'Male' ? 'uncle' : 'aunt';
      return self::aggrandize_relationship($rel, $b_dist, 1);
    }
    // NEPHEW / NIECE
    if ($b_dist == 1) {
      $rel = $npcA['gender'] == 'Male' ? 'nephew' : 'niece';
      return self::aggrandize_relationship($rel, $a_dist, 1);
    }

    // COUSINS, GENERATIONALLY REMOVED
    $cous_ord = min($a_dist, $b_dist) - 1;
    $cous_gen = abs($a_dist - $b_dist);
    return ($cous_ord > 1 ? 'distant ' : '').'cousin '; //.$this->format_plural($cous_gen, 'time', 'times').' removed';
  }

  static function aggrandize_relationship($rel, $dist, $offset = 0) {
    $dist -= $offset;
    switch ($dist) {
      case 1:
        return $rel;
        break;
      case 2:
        return 'grand'.$rel;
        break;
      case 3:
        return 'G grand'.$rel;
        break;
      default:
        return str_repeat("G", $dist - 2).' grand'.$rel;
    }
  }

  static function lowest_common_ancestor($npcA, $npcB)
  {
    $common_ancestors = self::common_ancestors($npcA, $npcB);

    $least_distance = -1;
    $ld_index = -1;

    foreach ($common_ancestors as $i => $c_anc) {
      $distance = $c_anc[1] + $c_anc[2];
      if ($least_distance < 0 || $least_distance > $distance) {
        $least_distance = $distance;
        $ld_index = $i;
      }
    }

    return $ld_index >= 0 ? $common_ancestors[$ld_index] : false;
  }

  static function common_ancestors($npcA, $npcB) {
    $common_ancestors = array();

    $a_ancestors = $npcA['ancestors'] ? $npcA['ancestors'] : self::getAncestors($npcA['id']);
    $b_ancestors = $npcB['ancestors'] ? $npcB['ancestors'] : self::getAncestors($npcB['id']);

    foreach ($a_ancestors as $a_anc) {
      foreach ($b_ancestors as $b_anc) {
        if ($a_anc[0] == $b_anc[0]) {
          $common_ancestors[] = array($a_anc[0], $a_anc[1], $b_anc[1]);
          break 1;
        }
      }
    }

    return $common_ancestors;
  }

  public function getAncestorsAttribute() {
      return self::getAncestors($this->id);
  }

  static function getAncestors($id, $dist = 0)
  {
    $ancestors = array();

    // SELF
    $ancestors[] = array($id, $dist);
      $npc = NPC::find($id);
    // PARENTS
    if (empty($npc) || $dist > 3) return $ancestors;

    if ($npc->parent_id){
        $par_ancestors = self::getAncestors($npc->parent_id, $dist + 1);
        foreach ($par_ancestors as $par_anc) {
          $ancestors[] = $par_anc;
        }
      }
    if ($npc->birth_parent_id) {
        $par_ancestors = self::getAncestors($npc->birth_parent_id, $dist + 1);
        foreach ($par_ancestors as $par_anc) {
          $ancestors[] = $par_anc;
        }
      }
    return $ancestors;
  } 

}
