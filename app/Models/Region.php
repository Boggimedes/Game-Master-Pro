<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model;
use \App\Models\Helpers\IndefiniteArticle\IndefiniteArticle;


class Region extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'racial_balance',
        'feature_types',
        'world_id',
        'prof_balance',
        'epoch',
        'cultures', 
        'religions', 
        'map',
        'processing'
    ];
    protected $appends = ['has_map'];
    private $transients = 0;
    private $yearlyBirths = 0;
    private $mailOrderFathers = 0;
    private $mailOrderBrides = 0;
    private $yearlyDeaths = 0;
    private $funerals = 0;
    private $births = 0;
    private $weddings = 0;
    private $potentialSpouse = null;
    private $potentialParent = null;
    private $profBalance = [];
    private $spouseOptions;
    private $fatherOptions;
    private $activeNPCs;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['world', 'map'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'racial_balance' => 'array',
        'prof_balance' => 'array',
        'feature_types' => 'object',
        'religions' => 'array',
        'cultures' => 'array',
        'states' => 'array',
        'files' => 'array',
    ];
    public function poi()
    {
        return $this->hasMany('App\Models\POI');
    }
    public function stories()
    {
        return $this->hasMany('App\Models\Story');
    }
    public function getHasMapAttribute() {
        return !!$this->map;
    }
    public function world()
	{
		return $this->belongsTo(World::class);
	}
	public function npcs()
	{
		return $this->hasMany(Npc::class, 'region_id');
	}
    public function seed()
    {
        \Log::info($this->racial_balance);
        if (empty($this->racial_balance)) {
            $racial_balance = [];
            $this->world->races->each(function ($r) use(&$racial_balance){
                $racial_balance[] = ['name' => $r->name, 'id' => $r->id, 'value' => 10];
            });
            $this->racial_balance = $racial_balance;
        }
        foreach($this->racial_balance as $race){
            for ($i = 1; $i < $race->value+1; $i++)
            {
                if($i % 2 == 0) $this->generateNpc(['race_id' => $race->id, 'age' => mt_rand(0, 15)]);
                $this->generateNpc(['race_id' => $race->id]);
            }
        }
    }
    public function getRacialBalanceObjectAttribute() {
        $value = $this->racial_balance;
        if (empty($value)) return [];
        if (is_string($value)) $value = json_decode($value);
        $value = collect($value);
        $value = $value->keyBy('id');
        return $value;
    }
    public function getRacialBalanceAttribute($value) {
        if (empty($value)) return [];
        if (is_array($value)) return $value;
        return json_decode($value);
    }
    public function getProfBalanceAttribute($value) {
        if (empty($value)) return [];
        if (is_array($value)) return $value;
        return json_decode($value);
    }
    public function getStatsAttribute()
    {
        $stats = [];
        foreach($this->world->races as $race) {
            $stats[] = [
                'name' => $race->name,
                'average_age%' => round(100*$this->npcs()->where('race_id',$race->id)->where('alive', 1)->avg('age')/$race->old_age),
                'children' => $this->npcs()->where('race_id',$race->id)->where('alive', 1)->whereBetween('age',[0,$race->adulthood])->count(),
                'adults' => $this->npcs()->where('race_id',$race->id)->where('alive', 1)->whereBetween('age',[$race->adulthood+1,$race->middle_age])->count(),
                'middle_age' => $this->npcs()->where('race_id',$race->id)->where('alive', 1)->whereBetween('age',[$race->middle_age+1,$race->old_age1])->count(),
                'old_age' => $this->npcs()->where('race_id',$race->id)->where('alive', 1)->where('age','>', $race->old_age)->count(),
                'immortal' => $this->npcs()->where('race_id',$race->id)->where('alive', '>',1)->count(),
                'living' => $this->npcs()->where('race_id',$race->id)->where('alive', '>',0)->count()
            ];
        }
        return collect($stats);
    }
    public function randomRace()
    {
        $balance = $this->racial_balance;
        $rand = mt_rand(1,100);
        $below = 0;
        foreach($balance as $race) {
            $below += $race['value'];
            if ($rand < $below) {
                return Race::find($race['id']);
            }
        }
    }
    public function age($years)
    {
		ini_set('max_execution_time', 1800);
        $start = microtime(true);
        $this->births = 0;
        $this->funerals = 0;
        $increment = 1;
        if ($years >= 25) $increment = 5;
        $this->potentialSpouse = collect([]);
        $this->potentialParent = collect([]);
        $this->activeNPCs = $this->npcs()->where([['excluded','!=', 1], ['alive', '>', 0]])->get()->keyBy('id');
        foreach($this->activeNPCs as $npc){
            if($npc->gender == key($npc->race->genders[0]) && !$npc->married && $npc->age > $npc->marryAge) $this->potentialSpouse[$npc->id] = $npc;
            if($npc->gender !== key($npc->race->genders[0]) && $npc->age >= $npc->race->adulthood && $npc->age < $npc->race->old_age) $this->potentialParent[$npc->id] = $npc;
        }
        for($y=0;$y<$years;$y += $increment) {
            $this->births += $this->yearlyBirths;
            $this->funerals += $this->yearlyDeaths;
            $this->yearlyBirths = 0;
            $this->yearlyDeaths = 0;
            $this->epoch += $increment;
            foreach($this->activeNPCs as $key => &$npc){
                    $npc = $this->deathCheck($npc, $increment);
                    if ($npc->alive === 0) {
                        $npc->save();
                        unset($this->activeNPCs[$key]);
                        if (property_exists($this->potentialSpouse, $npc->id)) unset($this->potentialSpouse[$npc->id]);
                        if (property_exists($this->potentialParent, $npc->id)) unset($this->potentialParent[$npc->id]);
                        continue;
                    }
                    $npc = $this->weddingBells($npc, $increment);  
                    $npc = $this->newChild($npc, $increment);

                    if($npc->age > $npc->race->adulthood/2) $npc = $this->ratRace($npc, $increment);
                    if (
                        $npc->age > $npc->marryAge && 
                        !$npc->married &&
                        $npc->gender == key($npc->race->genders[0]) &&
                        ($npc->age - $increment) < $npc->marryAge
                        ) {
                            $this->potentialSpouse[$npc->id] = $npc;
                        }
                    if (
                        $npc->age >= $npc->race->adulthood && $npc->age < $npc->race->old_age &&
                        $npc->gender !== key($npc->race->genders[0]) &&
                        ($npc->age - $increment) < $npc->race->adulthood
                        ) {
                            $this->potentialParent[$npc->id] = $npc;
                        }
                    $this->activeNPCs[$npc->id] = $npc; 
            }
            $this->save();
        }
        foreach($this->activeNPCs as $npc){
            $npc->save();
        }
        $oldestGeneration = $this->npcs()->where('alive',1)->min('generation') - 6;
        $this->npcs()->where('alive',0)->where('generation', '<', $oldestGeneration)->delete();
        $time_elapsed_secs = microtime(true) - $start;

        $this->save();
        }

    function generateNpc($npcData = [], $transient = false)
    {
        if (empty($npcData['race_id'])) {
            $race = $this->randomRace();
        } else {
            $race = Race::find($npcData['race_id']);
        }
        $npc = New Npc();
        if (empty($npcData['gender'])) {
            if (count($race->genders) == 1) {
                $npc->gender = key($race->genders[0]);
            } else {
                $npc->gender = key($race->genders[mt_rand(0, count($race->genders) - 1)]);
            }
        } else $npc->gender = $npcData['gender'];

        // $features = [];
        // $features['lineage'] = ['name' => 'lineage', 'text' => ''];
        // foreach ($this->feature_types as $featureType) {
        //     if (substr($featureType->name, 0, 7) == 'lineage' && empty($lineage['text'])) {
        //         $lineage = $this->generateFeature($featureType, $npc->gender, $race);
        //     } elseif (empty($features[$featureType->name])) $features[$featureType->name] = $this->generateFeature($featureType, $npc->gender, $race); //['name' => $featureType->name, 'text' => ''];
        // }
        $features  = $this->generateFeatures($npc->gender, $race, $transient);

        // if (!empty($lineage)) {
        //     $features['lineage']['text'] = $lineage['text'];
        // }
        if (!empty($npcData['lineage'])) $features['lineage']['text'] = $npcData['lineage'];

        $npc->alive = 1;
        if (!empty($features['alive'])) {
            $npc->alive = $features['alive'];
            unset($features['alive']);
        }
        if (!empty($features['abilities'])) {
            $npc->abilities = $features['abilities'];
            unset($features['abilities']);
        }
        if ($race->max_age === 0) $npc->alive = 2;
        $npc->features = $features;
        $npc->race_id = $race->id;
        $npc->age = !empty($npcData['age']) ? $npcData['age'] : mt_rand($race->adulthood/2, $race->adulthood * 1.1);
        $npc->abilities = null;
        $npc->region_id = $this->id;
        $npc->generation = array_key_exists('generation', $npcData) ? $npcData['generation'] : 1;
        $npc->birth_year = $this->epoch - $npc->age;
        $npc->excluded      = 0;
        $npc->user_id      = $this->world->user->id;
        $npc->name = 'NPC';

        if (array_key_exists('birth_parent_id', $npcData)) $npc->birth_parent_id = $npcData['birth_parent_id'];
        if (array_key_exists('parent_id', $npcData)) $npc->parent_id = $npcData['parent_id'];
        $npc->save();

        if ($this->world->user->settings && $this->world->user->settings->preGenNames) {
            $npc->generateName();
        } else {
            $npc->name = 'NPC' . $npc->refresh()->id;
        }

        return Npc::find($npc['id']);
    }
    function generateFeatures($gender = null, $race = null, $transient = false)
    {
        $features = [
            ["name" => "special", "chance" => 5],
            ["name" => "face shape", "chance" => 40],
            ["name" => "skin complexion", "chance" => 30],
            ["name" => "skin color", "chance" => 40],
            ["name" => "hair color", "chance" => 100],
            ["name" => "hair description", "chance" => 50],
            ["name" => "eye description", "chance" => 30],
            ["name" => "eye color", "chance" => 100],
            ["name" => "body", "chance" => 50],
            ["name" => "clothing", "chance" => 15],
            ["name" => "body extra", "chance" => 20],
            ["name" => "quirk", "chance" => 40],
            ["name" => "manner", "chance" => 100],
            ["name" => "lineage", "chance" => 2]
        ];
        if (empty($this->feature_types)) $this->feature_types = $features;
        $features = [];
        $featureCol = collect($this->feature_types)->keyBy('name');
        
        foreach ($this->feature_types as $featureType) {
            if (strpos($featureType->name, 'extra') > 0) continue;
            $descriptive = $this->generateFeature($featureType, $gender, $race);
            if (!empty($descriptive['alive'])) $features['alive'] = $descriptive['alive'];
            if (!empty($descriptive['abilities'])) $features['abilities'] = $descriptive['abilities'];
            unset($descriptive['abilities'], $descriptive['alive']);
            if (empty($features[$featureType->name]) || !$features[$featureType->name]['text']) $features[$featureType->name] = ['name' => $featureType->name, 'text' => ucfirst($descriptive['text'])];
            if (!empty($featureCol[$featureType->name . ' extra'])) {
                $extra = $featureCol[$featureType->name . ' extra'];
                if (empty($descriptive['subtype'])) continue;
                $extra->subtype = $descriptive['subtype'];
                $descriptive = $this->generateFeature($extra, $gender, $race);
                $features[$extra->name] = ['name' => $extra->name, 'text' => ucfirst($descriptive['text'])];
                if (!empty($descriptive['alive'])) $features['alive'] = $descriptive['alive'];
                if (!empty($descriptive['abilities'])) $features['abilities'] = $descriptive['abilities'];
            }
        }
        return $features;
    }
    function generateFeature($featureType, $gender = null, $race = null, $transient = false)
    {
        if (!empty($featureType->subtypes)) {
            $featureType->subtype = $this->wRand((array)$featureType->subtypes);
        }
        if (!empty($featureType->subtype) && $featureType->subtype != 'base') {
            $query = Descriptive::where([['type', $featureType->name],['subtype', $featureType->subtype], ['world_id',$this->world->id], ['random', 1]]);
        } else {
            $query = Descriptive::where([['type', $featureType->name], ['world_id',$this->world->id], ['random', 1]]);
        }

        if ($gender != null) {
            $query = $query->where(function ($q)  use($gender){
                $q->where('gender', $gender)->orWhereNull('gender');
            });
        }
        if ($race != null) {
            $query = $query->where(function ($q)  use($race){
                $q->where('race_id', $race->id)->orWhereNull('race_id');
            });
        }
        $rand = mt_rand(1, 1000);
        if ($featureType->name == 'lineage') {
            if ($transient) $featureType->chance = $featureType->chance * 10;
        }

        if ($rand > ($featureType->chance*10)) return ['name' => $featureType->name, 'text' => ''];
        $value = $query->get();
        if(!$value->isEmpty()) return $value->random(1)[0];
        return ['name' => $featureType->name, 'text' => ''];
    }

    private function deathCheck($npc, $increment = 1)
    {
        // $deathChance = (log10((($npc->age - $npc->race->adulthood)/($npc->race->maxAge))*2 + 0.85) - sin((($npc->age - $npc->race->adulthood)/($npc->race->maxAge))*2+0.85)+0.87)/($npc->race->maxAge/71);
        if ($npc->alive > 1) $deathChance = 1;
        else {
            if ($npc->alive === 0) return $npc;
            $deathChance = $npc->race->deathChance($npc->age);
            $deathChance = $deathChance * $increment;
        }
        if(mt_rand(1,1000) < $deathChance || ($npc->age >= $npc->race->max_age && $npc->alive < 2)) {
            $this->yearlyDeaths++;
            $npc->alive=0;
            $racialBalance = $this->racialBalanceObject->has($npc->race->id) ? $this->racialBalanceObject[$npc->race->id]->value : 0;
            if($this->npcs()->where([['alive', '>', 0], ['race_id', $npc->race->id]])->count() < $racialBalance) {
                $this->transients++;
                $transient = $this->generateNpc([
                    'age' => mt_rand($npc->race->adulthood,$npc->race->adulthood*2), 
                    'race_id' => $npc->race->id, 
                    'generation' => $npc->generation
                ], true);
                if($transient->gender == key($transient->race->genders[0]) && $npc->age > $npc->marryAge) $this->potentialSpouse[$transient->id] = $transient;
                else $this->potentialParent[$transient->id] = $transient;
                $this->activeNPCs[$transient->id] = $transient;
            }
            $randYear = mt_rand(0, $increment);
            $causeOfDeath = [
                'violently' => 10,
                'of exposure' => 10,
                'in a fire' => 10,
                'in a terrible accident' => 30,
                'of disease' => 50,
                'of dysentery...' => 5,
                'suddenly and mysteriously' => 10,
                'Killed by a member of the party...' => 1,
                'KBA (killed by adventurer)' => 10,
            ];
            if ($npc->ageGroup == 'old age') {
                $causeOfDeath[] = ['of old age' => 20];
                $causeOfDeath[] = ['of natural causes' => 20];
            }
            if ($npc->ageGroup == 'venerable') {
                $causeOfDeath[] = ['of old age' => 40];
                $causeOfDeath[] = ['of natural causes' => 40];
            }
            $cause = $this->wRand($causeOfDeath);

            $npc = $npc->addEvent(['age' => $npc->age + $randYear, 'text' => "died " . $cause, 'type' => 'death']);
            $target = ['id' => $npc->id, 'name' => $npc->name, 'age' => ($npc->age + $randYear)];
            if (!empty($npc->spouse)) {
                $spouse = $npc->spouse->addEvent(['age' => ($npc->spouse->age + $randYear), 'target' => $target, 'text' => "spouse died " . $cause, 'type' => 'spouse death']);
                $spouse->married = 2;
                if($spouse->gender == $spouse->race->otherGender && $spouse->age > $npc->race->middle_age && mt_rand(1,20) == 1) 
                    $spouse->married = 0;
                if($spouse->gender == $spouse->race->otherGender && $spouse->age < $npc->race->middle_age && mt_rand(1,10) <= 3) 
                    $spouse->married = 0;
                if($spouse->gender == $spouse->race->birthGender &&  mt_rand(1,10) <= 3 && $spouse->race->birthGender != $spouse->race->otherGender) 
                    $spouse->married = 0;
                $spouse->save();
                }
                if(!empty($npc->children)) {
                    if($npc->gender == $npc->race->birthGender[0]) $parentGender = "Birthing Parent";
                        else $parentGender = "Parent";
                    foreach($npc->children as $child){
                        if($child == "") continue;
                        $child = $child->addEvent(['age' => ($child->age + $randYear), 'target' => $target, 'text' => $parentGender . " died " . $cause, 'type' => strtolower($parentGender) . ' death']);
                        $child->save();
                    }
                }
                $npc->age = $npc->age + $increment;
            return $npc;
            }

            // $npc->save();
            $npc->age = $npc->age + $increment;
            return $npc;
    }
    private function ratRace($npc, $increment = 1)
    {
        $randYear = mt_rand(0, $increment);
        if($npc->profession_id && mt_rand(1, 100) > 1) return $npc;

        $getAJob = 10;
        if ($npc->age < $npc->race->adulthood) $getAJob = 30;
        $getAJob = max($getAJob / $increment, 2);
        if (mt_rand(1,$getAJob) == 1){
            $balanceTotal=0;
            if (empty($this->prof_balance)) 
            {
                $prof_balance = [];
                $this->world->professions->each(function ($p) use(&$prof_balance){
                    $prof_balance[] = ['name' => $p->name, 'id' => $p->id, 'value' => 1];
                });
                $this->prof_balance = $prof_balance;
            }
            $profList=[];
            foreach($this->prof_balance as $prof){
                $tmpValue = $prof->value;
                if($npc->parent && $npc->parent->profession && $npc->parent->profession->id == $prof->id ) $tmpValue *= 3;
                if($npc->birthingParent && $npc->birthingParent->profession && $npc->birthingParent->profession->id == $prof->id ) $tmpValue *= 3;
                $balanceTotal += $tmpValue;
                $profList[$prof->id] = $tmpValue;
            }
            $randResult = mt_rand(0, $balanceTotal);
            foreach($profList as $id => $value){
                $profession = Profession::find($id);
                $balanceTotal -= $value;
                $minAge = $profession->min_age;
                $maxAge = $profession->max_age;
                if($randResult >= $balanceTotal && ($minAge == 'none' || $npc->age >= $npc->race->$minAge) && ($maxAge == 'none' || $npc->age < $npc->race->$maxAge)){
                    $npc = $npc->addEvent(['age' => ($npc->age + $randYear), 'text' => IndefiniteArticle::A($profession->name), 'type' => 'job']);
                    $npc->profession_id = $profession->id;
                    // $npc->save();
                    return $npc;
                }
            }
        }
        return $npc;
    }
    private function weddingBells($npc, $increment = 1)
    {
        $randYear = mt_rand(0, $increment);
            if($npc->married || ($npc->isBirthing() &&  mt_rand(1,20) > 1) || $npc->age < $npc->race->adulthood ) return $npc;
            if(mt_rand(1,100/$increment) > (($npc->race->max_age - $npc->age) / max($npc->race->middle_age - $npc->age,1)/4)) return $npc;
            $marryAge = $npc->race->adulthood - $npc->race->middle_age/12;

            $family = $npc->family;
            $racialBalance = 5;
            if ($this->racialBalanceObject->has($npc->race->id)) $racialBalance = $this->racialBalanceObject[$npc->race->id]->value;
            $spouseOptions=collect([]);
            $spouse = null;
            foreach($this->potentialSpouse->random($this->potentialSpouse->count()) as $k){
                if(in_array($k->id,$family->toArray())) continue;
                if($k->race->id != $npc->race->id && mt_rand(1,30) > 1) continue;
                $spouse = $k;
                break;
            }

            if ($spouse !== null) $this->potentialSpouse = $this->potentialSpouse->except($spouse->id);

            if($spouse == null) {
                $npcData = [
                    'age' => mt_rand($npc->marryAge,$npc->age+5),
                    'race_id' => $npc->race->id,
                    'generation' => $npc->generation,
                ];
                $spouse = $this->generateNpc($npcData, true);
                $this->mailOrderBrides++;
           }
            
            // if(!isset($mailOrderBride)) {
            //     $spouseOptionsArray = $spouseOptions->toArray();
            //     usort($spouseOptionsArray, function($a,$b){
            //         $aR = mt_rand(1,$a['age']);
            //         $bR = mt_rand(1,$b['age']);
            //         if($aR<$bR) return -1;
            //         if($aR>$bR) return 1;
            //         if($aR==$bR) return $a['age'] - $b['age'];
            //     });
            //     $newSpouse = Npc::find($spouseOptionsArray[0]['id']);
            
            //     $this->potentialSpouse = $this->potentialSpouse->whereNotIn('id', [$newSpouse->id]);
            // }
    
            $target = ['id' => $npc->id, 'name' => $npc->name, 'age' => ($npc->age + $randYear)];
            $spouse = $spouse->addEvent(['age' => ($spouse->age + $randYear), 'text' => 'married ' . $npc->name, 'type' => 'marriage', 'target' => $target]);
    
            $this->weddings++;
            $spouse->married = 1;
            $spouse->spouse_id = $npc->id;
            $spouse->save();
    
            $target = ['id' => $spouse->id, 'name' => $spouse->name, 'age' => ($spouse->age + $randYear)];
            $npc = $npc->addEvent(['age' => ($npc->age + $randYear), 'text' => 'married ' . $spouse->name, 'type' => 'marriage', 'target' => $target]);
    
            $this->activeNPCs[$spouse->id] = $spouse;
            $npc->married = 1;
            $npc->spouse_id = $spouse->id;
            return $npc;
    }
    private function newChild($npc, $increment = 1)
    {
        $randYear = mt_rand(0, $increment);
        if(!$npc->isBirthing() || $npc->age < $npc->race->adulthood || $npc->age > ($npc->race->old_age)) return $npc;
        $racialBalance = $this->racialBalanceObject->has($npc->race->id) ? $this->racialBalanceObject[$npc->race->id]->value : 0;
        if($npc->alive > 1 || ($npc->spouse && $npc->spouse->alive > 1)) {
            $birthRate = 1;
        } else {
            $birthRate = (1 + (200 / (($npc->race->middle_age*1.3)-$npc->race->adulthood))) - ($npc->children->count()*2);
            if($npc->married){$birthRate += 3;}
            if($npc->married && !$npc->children->count()){$birthRate *= 5;}
            $idealBirthAgeLow = $npc->race->adulthood+(($npc->race->middle_age - $npc->race->adulthood)*.25);
            $idealBirthAgeHigh = $npc->race->adulthood+(($npc->race->middle_age - $npc->race->adulthood)*.75);
            if($npc->age >= $idealBirthAgeLow && $npc->age <= $idealBirthAgeHigh){$birthRate = $birthRate*1.5;}
            $living = $this->npcs()->where('race_id',$npc->race->id)->where('alive', '>',0)->count();
            if ($racialBalance) $birthRate -= max($living - ($racialBalance/2),-2)/($racialBalance/5);
            else $birthRate -= $living;
            //(pow(1.038-($racialBalance/10000),$this->racialBalance[$npc->race->name])/($racialBalance*10));
            $birthRate = 1000*($birthRate/(($npc->race->middle_age*1.3)-$npc->race->adulthood - 15));    
            // $birthRate = min($birthRate, 200);
        }
        $randResult = mt_rand(1,1000);
        $birthRate *= $increment;
        // $birthRate = min($birthRate - (75*$npc->children()->count()), 400);
        if($randResult > $birthRate) return $npc;
        $this->yearlyBirths++;

        if($npc->married && mt_rand(1,100) > 1 && $npc->spouse && $npc->spouse->alive > 0) {
            $father = property_exists($this->activeNPCs, $npc->spouse->id) ? $this->activeNPCs[$npc->spouse->id] : $npc->spouse;
        } else {
            $family = $npc->family;
            $father = null;
            foreach($this->potentialParent->random($this->potentialParent->count()) as $k) {
                if(in_array($k->id,$family->toArray())) continue;
                if($k->alive > 1 && $npc->alive > 1) continue;
                if($k->race->id != $npc->race->id && mt_rand(1,20) > max(1,20-$racialBalance)) continue;
                $father = $k;
                break;
            }
            if ($father !== null && ((strtolower($father->lineageName) != 'monarch' && strtolower($father->lineageName) != 'noble') || mt_rand(1,3) == 1)) $this->potentialParent = $this->potentialParent->except($father->id);

            if(!$father) {
                if ($npc->alive > 1) return $npc;
                $npcData = [
                    'age' => mt_rand($npc->age,$npc->age*2),
                    'race_id' => $npc->race->id,
                    'gender' => $npc->race->otherGender,
                    'generation' => $npc->generation
                ];
                $father = $this->generateNpc($npcData, true);
                $this->mailOrderFathers++;
            }
            
            // if(!isset($mailOrderFather)){
            //     $fatherOptionsArray = $fatherOptions->toArray();
            //     usort($fatherOptionsArray, function($a,$b){
            //         $aR = mt_rand(1,2);
            //         $bR = mt_rand(1,2);
            //         if($aR<$bR) return -1;
            //         if($aR>$bR) return 1;
            //         if($aR==$bR) return $a['age'] - $b['age'];
            //     });
            //     $father = Npc::find($fatherOptionsArray[0]['id']);
            //     $this->potentialParent = $this->potentialParent->whereNotIn('id', [$father->id]);
            // }
        }
        
        $childLineage = null;
        $possibleRaces = [];
        if ($npc->alive === 1) $possibleRaces[] = $npc->race->id;
        if ($father->alive === 1) $possibleRaces[] = $father->race->id;
        $parentRaces = [strtolower($npc->race->name), strtolower($father->race->name)];
        $parentLineage = [strtolower($npc->lineageName), strtolower($father->lineageName)];

        if($father->race->id !== $npc->race->id) {
            $half = $this->world->races()->where('name','LIKE','half%' . $npc->race->name)->first();
            if ($half) $possibleRaces[] = $half->id;
            $half = $this->world->races()->where('name','LIKE','half%' . $father->race->name)->first();
            if ($half) $possibleRaces[] = $half->id;
            if (array_search('celestial',array_map('strtolower',$parentRaces)) || 
                array_search('angel',array_map('strtolower',$parentRaces)) ||
                strpos(' ' . $parentLineage[0],'angel') > 0 || strpos(' ' . $parentLineage[1],'angel')
                ) {
                $childLineage = 'Half-Celestial';
            }
            if (array_search('fiend',array_map('strtolower',$parentRaces)) || 
                array_search('demon',array_map('strtolower',$parentRaces)) || 
                array_search('devil',array_map('strtolower',$parentRaces)) ||
                strpos(' ' . $parentLineage[0],'demon') > 0 || strpos(' ' . $parentLineage[1],'demon') ||
                strpos(' ' . $parentLineage[0],'devil') > 0 || strpos(' ' . $parentLineage[1],'devil')
                ) {
                $childLineage = 'Half-Fiend';
            }
        }

        if ((strpos(' ' . $parentLineage[0],'monarch') > 0 || strpos(' ' . $parentLineage[1],'monarch')) && ($npc->spouse->id == $father->id || $npc->isBirthing())) {
            $childLineage = 'Monarch';
        } 

        if ((strpos(' ' . $parentLineage[0],'nobility') > 0 || strpos(' ' . $parentLineage[1],'nobility')) && ($npc->spouse->id == $father->id || $npc->isBirthing())) {
            $childLineage = 'Nobility';
        } 


        if (strpos(' ' . $parentRaces[0],'celestial') > 0 || strpos(' ' . $parentRaces[1],'celestial') ||
            strpos(' ' . $parentRaces[0],'angel') > 0 || strpos(' ' . $parentRaces[1],'angel') ||
            strpos(' ' . $parentLineage[0],'celestial') > 0 || strpos(' ' . $parentLineage[1],'celestial')
        ) {
            $celestial = $this->world->races()->where('name','aasimar')->first();
            if ($celestial) $possibleRaces[] = $celestial->id;
            elseif (!$childLineage) $childLineage = 'Celestial';
        }

        if (strpos(' ' . $parentRaces[0],'fiend') > 0 || strpos(' ' . $parentRaces[1],'fiend') ||
            strpos(' ' . $parentRaces[0],'infernal') > 0 || strpos(' ' . $parentRaces[1],'infernal') ||
            strpos(' ' . $parentRaces[0],'devil') > 0 || strpos(' ' . $parentRaces[1],'devil') ||
            strpos(' ' . $parentRaces[0],'demon') > 0 || strpos(' ' . $parentRaces[1],'demon') ||
            strpos(' ' . $parentLineage[0],'fiend') > 0 || strpos(' ' . $parentLineage[1],'fiend')
        ) {
            $fiend = $this->world->races()->where('name','tiefling')->first();
            if ($fiend) $possibleRaces[] = $fiend->id;
            elseif (!$childLineage) $childLineage = 'Infernal';
        }

        if(strtolower($father->lineageName) == strtolower($npc->lineageName)) {
            $childLineage = $npc->lineageName;
        }
        $childLineage = mt_rand(1,100) < 50 ? $father->lineageName : $npc->lineageName;

        if($childLineage == "doppleganger") {
            $childLineage = "";
        }

        if(strtolower($father->lineageName) == "demigod"  || strtolower($npc->lineageName) == "demigod") {
            $childLineage = mt_rand(1,100) < 1? "Demigod": '';
        }

        if(strtolower($father->lineageName) == "deity"  || strtolower($npc->lineageName) == "deity") {
            $childLineage = mt_rand(1,100) < 5? "Demigod": '';
        }
        $possibleRaces = collect($possibleRaces);
        $childrenPerBirth = 0;
        do{
            if (!$childrenPerBirth) $childrenPerBirth = 1;
            else $childrenPerBirth++;

            $npcData = [
                'age' => 0,
                'race_id' => $possibleRaces->random(),
                'generation' => $npc->generation+1,
                'lineage' => $childLineage,
                'parent_id' => $father->id,
                'birth_parent_id' => $npc->id
            ];
            $descriptive = $this->world->descriptives()->where('text', $childLineage)->first();
            if (!empty($descriptive) && $descriptive->alive) $npcData['alive'] = $descriptive->alive;
            if (!empty($descriptive) && $descriptive->abilities) $npcData['abilities'] = $descriptive->abilities;
            $newNpc = $this->generateNpc($npcData);
            $this->yearlyBirths++;
            
            $adultry = '';
            $target = ['id' => $newNpc->id, 'name' => $newNpc->name, 'gender' => $newNpc->gender];
            if (empty($npc->spouse_id) || $npc->spouse_id !== $father->id) {
                $target['coparent'] =  ['id' => $father->id, 'name' => $father->name, 'gender' => $father->gender, 'race' => $father->race->name];
                $adultry = ' (illegitimate)';
            }
            $npc = $npc->addEvent([
                'age' => ($npc->age + $randYear), 
                'text' => $newNpc->name . 'is born' . $adultry, 
                'type' => 'birth', 
                'target' => $target]);

            if (empty($npc->spouse_id) || $npc->spouse_id !== $father->id) $target['coparent'] =  ['id' => $npc->id, 'name' => $npc->name, 'gender' => $npc->gender, 'race' => $npc->race->name];

            $father = $father->addEvent([
                'age' => ($father->age + $randYear), 
                'text' => $newNpc->name . 'is born' . $adultry, 
                'type' => 'birth', 
                'target' => $target]);
            $this->activeNPCs[$father->id] = $father;
            $this->activeNPCs[$newNpc->id] = $newNpc;
        
        } while(mt_rand(0,100)<(1 * $increment));
        return $npc;
    }
    public function clear()
    {
        $this->epoch = 0;
        $this->save();
        Npc::where('region_id', $this->id)->where('excluded',0)->delete();
    }

    function array_equal($a, $b) {
        return (
             is_array($a) 
             && is_array($b) 
             && count($a) == count($b) 
             && array_diff($a, $b) === array_diff($b, $a)
        );
    }

    public function newMarker($data) {
        $poi = $data['poi'];
        $svg = $data['svg'];
        $mapData = explode("\r\n", $this->map);
        $markers = json_decode($mapData[35]);
        $markers[] = $poi;
        $mapData[35] = json_encode($markers);
        if (!empty($svg)) $mapData[5] = $svg;
        $this->map = implode("\r\n", $mapData);
        $this->save();
    }
    public function getSettingsAttribute() {
        if (!$this->map) return ['mi', 3, 'square', 'ft', 2, '°F', 2, null, 0.2, null, null, null, 1000];
        $mapData = explode("\r\n", $this->map);
        $settings = explode("|", $mapData[1]);
        return $settings;

    }
    public function updateMapData($type, $data) 
    {
        $mapData = explode("\r\n", $this->map);
        $index = $type == "burgs" ? [15] : [4, 35];
        foreach($index as $i){
        $groupData = json_decode($mapData[$i]);

        for($e = 0; $e < count($groupData); $e++) {

            if (!empty($groupData[$e]->i) && !empty($data['i']) && $groupData[$e]->i == $data['i']) 
            {
                $groupData[$e] = $data;
                break;
            }
            if (!empty($groupData[$e]->id) && !empty($data['id']) && $groupData[$e]->id == $data['id']) 
            {
                $groupData[$e] = $data;
                break;
            }
        }
        $mapData[$i] = json_encode($groupData);
        }
        $this->map = implode("\r\n", $mapData);
        $this->save();
    }
    public function updateSVG($svg) {
        $mapData = explode("\r\n", $this->map);
        $mapData[5] = $svg;
        $this->map = implode("\r\n", $mapData);
        $this->save();
    }
    public function getMapItem($type, $i) 
    {
        $mapData = explode("\r\n", $this->map);
        $index = $type == "burgs" ? 15 : 4;
        $mapData = json_decode($mapData[$index]);
        foreach($mapData as $mapItem) {
            if (!empty($mapItem->i) && $mapItem->i == $i) 
            {
                return $mapItem;
            }
            if (!empty($mapItem->id) && $mapItem->id == 'marker' . $i) 
            {
                return $mapItem;
            }
        }
    }

    public function getMarker($id) 
    {
        $mapData = explode("\r\n", $this->map);
        $markerData = $mapData[4];
        $markerArray = explode('},{', $markerData);
        foreach($markerArray as $row) {
            if(!json_decode('{' . $row . '}')) {
                \Log::warning("Null Decode");
                \Log::info($row);
            }
        }
        return;
        foreach($markerData as $marker) {
            if (empty($marker->id)) continue;
            $mid = 'marker' . $id;
            if ($marker->id == $mid){
                return $marker;
            }
        }
    }
function removeInvalidChars( $text) {
    $regex = '/( [\x00-\x7F] | [\xC0-\xDF][\x80-\xBF] | [\xE0-\xEF][\x80-\xBF]{2} | [\xF0-\xF7][\x80-\xBF]{3} ) | ./x';
    return preg_replace($regex, '$1', $text);
}
private function wRand(array $weightedValues) {
    $rand = mt_rand(1, (int) array_sum($weightedValues));

    foreach ($weightedValues as $key => $value) {
      $rand -= $value;
      if ($rand <= 0) {
        return $key;
      }
    }
  }
}
