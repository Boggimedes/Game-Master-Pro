<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Descriptive;
use App\Models\World;

class DescriptiveController extends Controller
{
    public function create(Request $request, World $world) {
        $me = \Auth::user();
        if(empty($me) || $world->user_id !== $me->id) abort(401);
        $descriptive = [
            'world_id' => $world->id,
            'abilities' => $request->get('abilities'),
            'race_id' => $request->get('race_id'),
            'alive' => $request->get('alive'),
            'gender' => $request->get('gender'),
            'text' => $request->get('text'),
            'type' => $request->get('type'),
            'subtype' => $request->get('subtype')
        ];
        $new = Descriptive::create($descriptive);
        return response()->json(['message' => "Descriptive Created", 'descriptive' => $new ]);
    }

    public function delete(Descriptive $descriptive) {
        $me = \Auth::user();
        if(empty($me) || $descriptive->world->user_id !== $me->id) abort(401);
        $descriptive->delete();
        return response()->json(['message' => "Descriptive Deleted"]);
    }

    public function update(Request $request, Descriptive $descriptive) {
        $me = \Auth::user();
        if(empty($me) || $descriptive->world->user_id !== $me->id) abort(401);
        $descriptiveData = [
            'world_id' => $descriptive->world->id,
            'abilities' => $request->get('abilities'),
            'race_id' => $request->get('race_id'),
            'alive' => $request->get('alive'),
            'gender' => $request->get('gender'),
            'text' => $request->get('text'),
            'type' => $request->get('type'),
            'subtype' => $request->get('subtype')
        ];
        $descriptive->update($descriptiveData);
        return response()->json(['message' => "Descriptive Updated", 'descriptive' => $descriptive ]);
    }

}
