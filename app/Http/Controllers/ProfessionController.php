<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profession;
use App\Models\World;

class ProfessionController extends Controller
{
    public function create(Request $request, World $world) {
        $me = \Auth::user();
        if(empty($me) || $world->user_id !== $me->id) abort(401);
        $profession = [
            'world_id' => $world->id,
            'name' => $request->get('name'),
            'min_age' => $request->get('min_age'),
            'max_age' => $request->get('max_age'),
        ];
        $new = Profession::create($profession);
        return response()->json(['message' => "Profession Created", 'profession' => $new ]);
    }
    public function delete(Profession $profession) {
        $me = \Auth::user();
        if(empty($me) || $profession->world->user_id !== $me->id) abort(401);
        $profession->delete();
        return response()->json(['message' => "Profession Deleted"]);
    }
    public function update(Request $request, Profession $profession) {
        $me = \Auth::user();
        if(empty($me) || $profession->world->user_id !== $me->id) abort(401);
        $professionData = [
            'world_id' => $profession->world_id,
            'name' => $request->get('name'),
            'min_age' => $request->get('min_age'),
            'max_age' => $request->get('max_age'),
        ];
        $profession->update($professionData);
        return response()->json(['message' => "Profession Updated", 'profession' => $profession ]);
    }
}
