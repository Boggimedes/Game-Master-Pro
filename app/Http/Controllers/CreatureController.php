<?php

namespace App\Http\Controllers;
use App\Models\Creature;
use Illuminate\Http\Request;

class CreatureController extends Controller
{
    function getCreatures(Request $request, $term = "")
    {
		// $me = \Auth::user();
        // if(empty($me)) {
        //     abort(401);
        // }
        $whereStr = null;
        $where = null;

        $start = microtime(true);
        $creatures=[];
        if ($request->has('where')){
            $whereStr = $request->get('where');
            if ($term) $whereStr .= " AND `name` LIKE '%$term%'";
        } else if ($term) $whereStr = " WHERE `name` LIKE '%$term%'";

        // $creatures = $me->creatures()->where('name', 'LIKE', "%$term%");

        // if(empty($me->settings->default_creatures) || $me->settings->default_creatures) {
            \Log::info("where");
            \Log::info($request->has('where'));
            \Log::info($request->all());
            \Log::info($request->where);
            \Paginator::setCurrentPage($request->page);
            if (!empty($term) || $request->has('where')) {
                \Log::info($whereStr);
                $creatures = Creature::whereRaw($whereStr)->paginate(36)->toArray();
            } else $creatures = Creature::paginate(36)->toArray();

                // ->union($creatures)
                // ->where('name', 'LIKE', "%$term%");
                $time_elapsed_secs = microtime(true) - $start;
                // }
        \Log::info($time_elapsed_secs);
        $time_elapsed_secs = microtime(true) - $start;
        \Log::info($time_elapsed_secs);
        // $creatures['data'] = Creature::hydrate($creatures['data']);
        $time_elapsed_secs = microtime(true) - $start;
        \Log::info($time_elapsed_secs);
        //     $creatureQuery = "(SELECT * FROM (SELECT * FROM creatures WHERE user_id = '$me->id'
        //         UNION ALL SELECT * FROM creatures WHERE user_id = 1) AS creature GROUP BY `name` ORDER BY `name` DESC) as m ";
        //  else $creatureQuery = "(SELECT * FROM creature WHERE user_id = '$me->id') as m ";
        // $query = "SELECT * FROM $creatureQuery $whereStr";
        // \Log::info($query);
        // $creatures = \DB::select($creatureQuery);
        // SELECT * FROM (SELECT * FROM (SELECT * FROM creatures WHERE user_id = 1 UNION ALL SELECT * FROM creatures WHERE user_id = 1) AS creature GROUP BY `name` ORDER BY `name` DESC) AS creatures  WHERE name LIKE "%skeleton%"
        // SELECT * FROM (SELECT * FROM (SELECT * FROM creatures WHERE user_id = 1 UNION ALL SELECT * FROM creatures WHERE user_id = 1) AS creature GROUP BY `name` ORDER BY `name` DESC) AS creatures  WHERE `name` LIKE '%skeleton%'
        return response()->json($creatures);
    }
    function addCreature(Request $request) 
    {
        $me = \Auth::user();
        if(empty($me)) {
            abort(401);
        }
        $creatureData = $request->get('creature');
        $creatureData['user_id'] = $me->id;
        $creature = Creature::create($creatureData);
        return response()->json(['creature' => $creature]);
        }
    
    function updateCreature(Request $request, Creature $creature)
    {
        $me = \Auth::user();
        if(empty($me) || $creature->user_id !== $me->id) {
            abort(401);
        }
        if($creature['user_id'] == 1 && $me->id != 1) unset($creature['id']);
        $creatureData = $request->get('creature');
        $creature = Creature::updateOrCreate($creatureData);
        if($request->has('file')){
            $name = "/". $creature->id .".jpg";
            if($me->id == 1) {
                $directory = "/mImages";
            } else $directory = "/mImages/".$me->id;
            $creature->img = $directory . $name;
            $file =$request->get("file");
        }

        if(isset($file)){
            if (!file_exists($directory)) mkdir($directory, 0755, true);
            $file->moveTo($directory."/$name");
        } 
        
        return response()->json(['creature' => $creature]);
    }
    function deleteCreature(Creature $creature)
    {
        $me = \Auth::user();
        if(empty($me) || $creature->user_id !== $me->id) {
            abort(401);
        }
        $creature->delete();
        
        return response()->json(['message' => "Deleted record ".$creature->id]);
        }
    
    }
