<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Region;
use App\Models\World;
use App\Models\Npc;
use App\Models\POI;
use App\Jobs\ProcessAging;
use Illuminate\Support\Facades\Storage;

class RegionController extends Controller
{
    function delete(Region $region)
    {
        $me = \Auth::user();
        if(empty($me) || $region->world->user_id !== $me->id) abort(401);
        $region->delete();
        return response()->json(['message' => 'Region Deleted']);
    }
    function read(Request $request, Region $region)
    {
        $me = \Auth::user();
        if(empty($me) || $region->world->user_id !== $me->id) abort(401);
        return response()->json(['region' => $region->load('stories')]);
    }
    function ping(Request $request, Region $region)
    {
        $me = \Auth::user();
        if(empty($me) || $region->world->user_id !== $me->id) abort(401);
        if (!$region->processing) {
            return response()->json(['processing' => 0, 'stats' => $region->stats, 'epoch' => $region->epoch]);
        }
        return response()->json(['processing' => 1, 'stats' => [], 'epoch' => $region->epoch]);
    }
    function clear(Region $region)
    {
        $me = \Auth::user();
        if(empty($me) || $region->world->user_id !== $me->id) abort(401);
        $region->clear();
        $region->append('stats');
        return response()->json(['region' => $region]);
    }
    public function seed(Region $region)
    {
		$me = \Auth::user();
        if(empty($me) || $region->world->user_id !== $me->id) abort(401);
        $region->seed();
        $region->append('stats');
        return response()->json(['message' => 'Region Seeded', 'region' => $region]);
    }
    public function age(Region $region, $years)
    {
		$me = \Auth::user();
        if(empty($me) || $region->world->user_id !== $me->id) abort(401);
        ProcessAging::dispatch($region, $years);
        // $region->age($years);
        // $region->append('stats');
        $region->processing = true;
        // $region->save();
        return response()->json(['message' => 'Region Aging...', 'region' => $region]);
    }
    public function create(Request $request, World $world)
    {
		$me = \Auth::user();
        if(empty($me)) abort(401);
        $region = [];
        if ($request->has('region')) {
            $region = $request->get('region');
        }
        $region['world_id'] = $world->id;
        if (empty($region['feature_types'])) {
            $descriptiveTypesAndSubs = $world
                ->descriptives()
                ->whereNotNull('type')
                ->select('type', 'subtype')
                ->groupBy('type', 'subtype')
                ->get();
            $descriptiveTypes = [];
            $descriptiveTypesAndSubs->each(function ($desc) use(&$descriptiveTypes) {

                if (array_key_exists($desc->type, $descriptiveTypes) && $desc->subtype != null) {
                    $descriptiveTypes[$desc->type]['subtypes'][] = $desc->subtype;
                } else $descriptiveTypes[$desc->type] = ['type' => $desc->type, 'subtypes'=> []];
            });
            $featureTypes = [];
            foreach ($descriptiveTypes as $type) {
                if (strpos($type['type'], 'extra') > 0) continue;
                $featureTypes[$type['type']] = ['name' => $type['type'], 'chance' => 0, 'subtypes' => ['base' => 100]];
                if (count($type['subtypes'])) {
                    foreach ($type['subtypes'] as $subtype) {
                        $featureTypes[$type['type']]['subtypes'][$subtype] = 50;
                    }
                }
            }
            $region['feature_types'] = $featureTypes;
        }
        $region = Region::create($region);
        $region = Region::find($region->id);
        $region->append('stats');
        return response()->json(['message' => 'Region Created', 'region' => $region]);
    }
    public function update(Request $request, Region $region)
    {
		$me = \Auth::user();
        if(empty($me)) abort(401);
        $validatedData = $request->validate([
            'name'  => 'nullable|string',
            'feature_types'  => 'nullable|array',
            'epoch' => 'nullable|numeric',
            'prof_balance'  => 'nullable|array',
            'racial_balance'    => 'nullable|array',
        ]);

        $validatedData['world_id'] = $region->world->id;

        $region->update($validatedData);
        $region->append('stats');
        return response()->json(['message' => 'Region Saved', 'region' => $region]);
    }
    public function mapGenerator(Request $request, Region $region)
    {
		// $me = \Auth::user();
        // if(empty($me) || $region->world->user_id !== $me->id) abort(401);


        return view('map-generator',['region' => $region]);

    }
    public function uploadFile(Request $request, Region $region) {
		$me = \Auth::user();
        if(empty($me) || $region->world->user_id !== $me->id) abort(401);
        $request->validate([
        'file' => 'required|mimes:jpg,txt,png,webp|max:12288'
        ]);


        if($request->file()) {
            $fileName = $request->file->getClientOriginalName();
            if (Storage::disk('s3')->exists('region/' . $region->id . '/' . $fileName)) {
                Storage::disk('s3')->delete('region/' . $region->id . '/' . $fileName);
            }
            \Log::info($fileName);
            Storage::disk('s3')->makeDirectory('region/' . $region->id, 'public');
            Storage::disk('s3')->put('region/' . $region->id . '/' . $fileName, file_get_contents($request->file('file')), 'public');
            // Storage::disk('s3')->put('map/rt' . $region->id . '.png', base64_decode($image), 'public');

            $files = $region->files;
            $files[] = 'region/' . $region->id . '/' . $fileName;
            \Log::info(print_r($files,1));
            $region->files = collect($files)->unique()->toArray();
            $region->save();

            return response()->json(['message' => "File Successfully", 'region' => $region->refresh()]);
        }
   }
    public function uploadMap(Request $request, Region $region)
    {
		$me = \Auth::user();
        // if(empty($me) || $region->world->user_id !== $me->id) abort(401);
        $data = $request->all();
        $data['states'] = json_decode($data['states']);
        $data['religions'] = json_decode($data['religions']);
        $validatedData = \Validator::make(
            $data,
            [
            'map'  => 'string',
            'url'  => 'string',
            'states'  => 'array',
            'religions'  => 'array',
        ]
        )->validated();
        $image = $validatedData['url'];
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        if (Storage::disk('s3')->exists('map/rt' . $region->id . '.png')) {
            Storage::disk('s3')->delete('map/rt' . $region->id . '.png');
        }
        Storage::disk('s3')->put('map/rt' . $region->id . '.png', base64_decode($image), 'public');
        $pattern = "/ns\d+:/";
        $region->map = preg_replace($pattern, "", $validatedData['map']);
        $region->states = $validatedData['states'];
        $region->religions = $validatedData['religions'];
        $region->save();

        // $this->createPOI('burgs', $validatedData['burgs'], $region);
        // $this->createPOI('markers', $validatedData['markers'], $region);
        return response()->json(['message' => "Map Uploaded Successfully"]);
        
    }
    public function createPOI(Request $request, Region $region)
    {
        $data = $request->all();
        $region->newMarker($data);
        return response()->json(['message' => ucfirst($data['poi']['type']) . " Created"]);
    }
    public function getMap(Region $region)
    {
		// $me = \Auth::user();
        // if(empty($me) || $region->world->user_id !== $me->id) abort(401);
        $map = $region->map;
        // return response()->json($region->map);
        // header("Content-type: image/svg+xml");

        // return response()->json($map);
        return response()->make($map, '200', array('Content-Type' => 'image/svg+xml'));
    }
    public function getPOI(Region $region, $type, $i)
    {
        $poi = POI::where('type', $type)->where('region_id', $region->id)->where('id', $i)->first();
        if (empty($poi)) {
            $poi = POI::create(['type' => $type, 'region_id' => $region->id, 'id' => $i]);
        }
        $mapData = $region->getMapItem($type, $i);
        $poi = $poi->appendNpcs();
        $poi = collect($poi)->merge($mapData)->toArray();

        if (empty($poi['notes']) && !empty($poi['legend'])) $poi['notes'] = $poi['legend'];
        return response()->json($poi);
   }
    public function updatePOI(Request $request, Region $region)
    {
        $data = $request->all();
        $poiData = $data['poi'];
        if ($request->has('poi.capital')) $poiData['type'] = 'burgs';
        $poi = POI::firstOrCreate(['type' => $poiData['type'], 'region_id' => $region->id, 'id' => $poiData['i']]);
        $poi->notes = !empty($poiData['notes']) ? $poiData['notes'] : "";
        $poi->hooks = !empty($poiData['hooks']) ? $poiData['hooks'] : "";
        $poi->save();
        $region->updateMapData($poiData['type'], $poiData);
        return response()->json(['poi' => array_merge($poi->toArray(), $poiData)]);
    }
    public function updateSVG(Request $request, Region $region)
    {
        $data = $request->all();
        $svg = $data['svg'];
        $region->updateSVG($svg);
        return response()->json(['message' => "SVG Updated"]);
    }
    public function attachNPC(Region $region, $type, $i, Npc $npc)
    {
        $poi = POI::where('type', $type)->where('region_id', $region->id)->where('id', $i)->first();
        if (empty($poi)) {
            $poi = POI::create(['type' => $type, 'region_id' => $region->id, 'id' => $i]);
        }
        $poi->attachNpcs([$npc->id]);
        return response()->json($npc);
    }
    public function detachNPC(Region $region, $type, $i, Npc $npc)
    {
        $poi = POI::where('type', $type)->where('region_id', $region->id)->where('id', $i)->first();
        if (empty($poi)) {
            $poi = POI::create(['type' => $type, 'region_id' => $region->id, 'id' => $i]);
        }
        $poi->detachNpcs([$npc->id]);
        return response()->json($npc);
    }
}
