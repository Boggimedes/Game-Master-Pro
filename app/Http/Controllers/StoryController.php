<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;
use App\Models\Story;
use App\Models\Region;

class StoryController extends Controller
{
    function getCampaigns(Request $request)
    {
		$me = \Auth::user();
        if(empty($me)) {
            abort(401);
        }
        $campaigns = $me->campaigns()->select('id', 'name', 'tags', 'current_day')->get();
        return response()->json(['campaigns' => $campaigns]);
    }
    //
    function getCampaign(Request $request, Campaign $campaign)
    {
		$me = \Auth::user();
        if(empty($me) || $campaign->user_id == $me->id) {
            abort(401);
        }

        return response()->json(['campaign' => $campaign]);
    }
    public function create(Request $request, Region $region) {
        $me = \Auth::user();
        if(empty($me) || $region->world->user_id !== $me->id) abort(401);
        $story = [
            'region_id' => $region->id,
            'name' => $request->get('name'),
            'chapters' => $request->get('chapters'),
        ];
        $new = Story::create($story);
        return response()->json(['message' => "Story Created", 'story' => $new ]);
    }
    public function delete(Story $story) {
        $me = \Auth::user();
        if(empty($me) || $story->region->world->user_id !== $me->id) abort(401);
        $story->delete();
        return response()->json(['message' => "Story Deleted"]);
    }
    public function read(Story $story) {
        $me = \Auth::user();
        if(empty($me) || $story->region->world->user_id !== $me->id) abort(401);
        return response()->json($story);
    }
    public function update(Request $request, Story $story) {
        $me = \Auth::user();
        if(empty($me) || $story->region->world->user_id !== $me->id) abort(401);
        $storyData = [
            'region_id' => $story->region->id,
            'name' => $request->get('name'),
            'chapters' => $request->get('chapters'),
        ];
        $story->update($storyData);
        return response()->json(['message' => "Story Updated", 'story' => $story ]);
    }
}
