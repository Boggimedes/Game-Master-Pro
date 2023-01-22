<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Race;
use App\Models\World;

class RaceController extends Controller
{
    public function create(Request $request, World $world) {
        $me = \Auth::user();
        if(empty($me) || $world->user_id !== $me->id) abort(401);
        $race = [
            'world_id' => $world->id,
            'name' => $request->get('name'),
            'genders' => $request->get('genders'),
            'adulthood' => $request->get('adulthood'),
            'middle_age' => $request->get('middle_age'),
            'old_age' => $request->get('old_age'),
            'venerable' => $request->get('venerable'),
            'max_age' => $request->get('max_age')
        ];
        $new = Race::create($race);
        return response()->json(['message' => "Race Created", 'race' => $new ]);
    }
    public function delete(Race $race) {
        $me = \Auth::user();
        if(empty($me) || $race->world->user_id !== $me->id) abort(401);
        $race->delete();
        return response()->json(['message' => "Race Deleted"]);
    }
    public function update(Request $request, Race $race) {
        $me = \Auth::user();
        if(empty($me) || $race->world->user_id !== $me->id) abort(401);
        $raceData = [
            'world_id' => $race->world_id,
            'name' => $request->get('name'),
            'plural' => $request->get('plural'),
            'adjective' => $request->get('adjective'),
            'genders' => $request->get('genders'),
            'adulthood' => $request->get('adulthood'),
            'middle_age' => $request->get('middle_age'),
            'old_age' => $request->get('old_age'),
            'venerable' => $request->get('venerable'),
            'max_age' => $request->get('max_age')
        ];
        $race->update($raceData);
        return response()->json(['message' => "Race Updated", 'race' => $race ]);
    }
}
