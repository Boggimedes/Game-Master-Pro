<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Npc;
use App\Models\World;
use App\Models\Region;

class NpcController extends Controller
{
    public function read(Request $request, Npc $npc)
    {
        $me = \Auth::user();
        if(empty($me) || $npc->user_id !== $me->id) abort(401);
        $npc = $npc->load('race', 
                    'profession',
                    'spouse', 
                    'spouse.race', 
                    'spouse.profession',
                    'birthParent', 
                    'birthParent.race', 
                    'birthParent.profession',
                    'parent', 
                    'parent.race', 
                    'parent.profession');
        $npc = $npc->append('children','ancestors');
        $history = $request->session()->get('recentNPC',[]);
        if ($history && $history[0] == null) $history = collect([]);
        else $history = collect($history);
        $current = $npc;
        $npc = $npc->toArray();
        \Log::info($current->gender);
        $history = $history->filter(function($npc) use($current){return $npc['id'] != $current->id;});
        $history = $history->prepend([
            "id" => $current->id,
            "name" => $current->name,
            "ancestors" => $current->ancestors,
            "profession" => $current->profession_id ? $current->profession->name : "",
            "race" => $current->race->name,
            "features" => $current->features,
            "age" => $current->age,
            "gender" => $current->gender,
            "alive" => $current->alive,
            ])->slice(0, 13)->map(function ($npc) use($current) {
                \Log::info($npc['gender']);
                $npc['relation'] = Npc::calculateRelationship($npc, $current->toArray());
                return $npc;
            })->toArray();
        $npc['relatives'] = $history;
        $request->session()->put('recentNPC',$history);
        return response()->json([ 'npc' => $npc ]);
        }

    public function fullList(Request $request, Region $region)
    {
        $me = \Auth::user();
        if(empty($me)) abort(401);
        return response()->json([
            'region' => $region,
            'npcs' => $region
                ->npcs()
                ->where('alive', '>', 0)
                ->get()
                ->load('race', 
                    'profession',
                    'spouse', 
                    'spouse.race', 
                    'spouse.profession',
                    'birthParent', 
                    'birthParent.race', 
                    'birthParent.profession',
                    'parent', 
                    'parent.race', 
                    'parent.profession')
                ->append('children')]); //->select(['name','id'])
    }
    public function list(Request $request, Region $region)
    {
        $me = \Auth::user();
        if(empty($me)) abort(401);
        return response()->json([
            'region' => $region,
            'npcs' => $region
                ->npcs()
                ->where('alive', '>', 0)
                ->get()
                ->load('race', 
                    'profession')]); //->select(['name','id'])
    }
    public function delete(Npc $npc) {
        $me = \Auth::user();
        if(empty($me) || $npc->region->world->user_id !== $me->id) abort(401);
        $npc->delete();
        return response()->json(['message' => "NPC Deleted"]);
    }
    public function generate(Request $request, Region $region)
    {
        $me = \Auth::user();
        if(empty($me)) abort(401);
        $npcData = $request->get('npc-data');
        $npc = $region->generateNpc($npcData);
        return response()->json(['message' => "NPC Created", 'npc' => $npc]);
    }
    public function update(Request $request, Npc $npc)
    {
        $me = \Auth::user();
        if(empty($me)) abort(401);
        $npcData = $request->all();
        $npcData['user_id'] = $me->id;
        $npc->update($npcData);

        return response()->json(['message' => 'NPC Updated', 'npc' => $npc]);
    }
    public function create(Request $request)
    {
		$me = \Auth::user();
        $npcData = $request->get('npc_data');
        $npcData['user_id'] = $me->id;
        $npc = Npc::create($npcData);
        return response()->json(['message' => 'Created NPC', 'npc' => $npc]);
        }
}
