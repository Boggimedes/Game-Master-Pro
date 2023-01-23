<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\World;
use App\Models\Region;
use App\Models\Npc;
use App\Models\POI;
use App\Jobs\ProcessAging;
use Illuminate\Support\Facades\Storage;

class WorldController extends Controller
{
    public function read(Request $request, World $world) 
    {
		$me = \Auth::user();
        if(empty($me) || $world->user_id !== $me->id) abort(401);
        $descriptiveTypesAndSubs = $world
            ->descriptives()
            ->whereNotNull('type')
            ->select('type', 'subtype')
            ->groupBy('type', 'subtype')
            ->get();
        $lineage = $world
            ->descriptives()
            ->where('type', 'lineage')
            ->orderBy('text')
            ->select('text')
            ->get()->pluck('text');
        $descriptiveTypes = [];
        $descriptiveTypesAndSubs->each(function ($desc) use(&$descriptiveTypes) {

            if (array_key_exists($desc->type, $descriptiveTypes) && $desc->subtype != null) {
                $descriptiveTypes[$desc->type]['subtypes'][] = $desc->subtype;
            } else $descriptiveTypes[$desc->type] = ['type' => $desc->type, 'subtypes'=> []];
        });

      $response = [
            'id' => $world->id,
            'name' => $world->name,
            'lineage_types' => $lineage,
            'descriptive_types' => collect($descriptiveTypes)->sort(),
            'descriptives' => $world->descriptives->toArray(),
            'professions' => $world->professions->toArray(),
            'races' => $world->races->toArray(),
            'campaigns' => $me->campaigns->toArray(),
            'regions' => $world->regions->toArray(),
            'stats' => $world->stats()
        ];

        return response()->json($response);
    }
    public function update(Request $request, World $world) 
    {
		$me = \Auth::user();
        if(empty($me) || $world->user_id !== $me->id) abort(401);
        $world->name = $request->has('name') ? $request->get('name') : $world->name;
        $world->save();
        return response()->json(['message' => 'updated ' . $world->name]);
    }
    public function getWorldFromRegion(Request $request, Region $region)
    {
        return $this->read($request, $region->world);
    }
    public function generateFeatures(Request $request, Npc $npc)
    {
		$me = \Auth::user();
        if(empty($me) || $npc->region->world->user_id !== $me->id) abort(401);
        $validatedData = $request->validate([
            'locked_features'  => 'nullable|array',
        ]);
        $features = $npc->region->generateFeatures($npc->gender, $npc->race);
        $npc->features = collect($npc->features)->keyBy('name')->merge(collect($features)->keyBy('name')->except($validatedData['locked_features']))->values()->filter(function ($value) {return !empty($value);});
        $npc->save();
        return response()->json(['npc' => $npc->refresh()]);
    }
    public function create()
    {
		$me = \Auth::user();
        if(empty($me)) abort(401);
        $count = World::where([['user_id','=',$me->id],['name','like','New World%']])->count();
        $countString = $count ? ('New World ' . ($count+1)) : 'New World';
        $newWorld = World::create(['user_id' => $me->id, 'name' => $countString]);
        return response()->json($newWorld);
    }
    public function copy(Request $request, World $target, World $source = null)
    {
		$me = \Auth::user();
        if(empty($me)) abort(401);
        $relation = $request->get('relation');
        if ($target == null) {
            $count = World::where([['user_id','=',$me->id],['name','like','New World%']])->count();
            $countString = $count ? ('New World ' . ($count+1)) : 'New World';
            $target = World::create(['user_id' => $me->id, 'name' => $countString]);
        }
        //copy attributes
        // $new = $this->replicate();

        //save model before you recreate relations (so it has an id)
        // $new->push();

        if ($relation) {
            $target->{$relation}()->delete();
            foreach ($source->{$relation} as $r) {
                $rel = collect($r->toArray())->except(['id', 'world_id'])->toArray();
                $rel['world_id'] = $target->id;
                $target->{$relation}()->create($rel);
            }
        } else {
            $target->descriptives()->delete();
            $target->races()->delete();
            $target->professions()->delete();
            foreach ($source->descriptives as $d) {
                $desc = collect($d->toArray())->except('id', 'world_id')->toArray();
                $desc['world_id'] = $target->id;
                $target->descriptives()->create($desc);
            }
            foreach ($source->races as $r) {
                $races = collect($r->toArray())->except('id', 'world_id')->toArray();
                $races['world_id'] = $target->id;
                $target->races()->create($races);
            }
            foreach ($source->professions as $p) {
                $professions = collect($p->toArray())->except('id', 'world_id')->toArray();
                $professions['world_id'] = $target->id;
                $target->professions()->create($professions);
            }
        }
        //reset relations on EXISTING MODEL (this way you can control which ones will be loaded
        // $source->relations = [];

        //load relations on EXISTING MODEL
        // $source->load('relation1','relation2');

        //re-sync everything
        // foreach ($source->relations as $relationName => $values){
        //     \Log::info(print_r($relationName));
        //     \Log::info(print_r($values));
        //     $target->{$relationName}()->sync($values);
        // }        
        return response()->json($target);
    }
    public function delete(World $world)
    {
		$me = \Auth::user();
        if(empty($me) || $world->user_id !== $me->id) abort(401);
        $world->delete();
        return response()->json(["message" => $world->name . " Deleted", "user" => $me->refresh()->withSearchList()]);
    }
}

