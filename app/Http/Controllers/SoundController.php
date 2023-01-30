<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\User;
use App\Models\Scene;
use App\Models\Sound;
use App\Models\Effect;

class SoundController extends Controller
{
        public function attachScene(Request $request, Collection $collection, Scene $scene) {
            $me = \Auth::user();
            if(empty($me)) {
                abort(401);
            }
            $collection->scenes()->attach($scene);

            return response()->json($this->fetchSounds(null, $me));
        }
        public function detachScene(Request $request, Collection $collection, Scene $scene) {
            $me = \Auth::user();
            if(empty($me) || $me->id != $collection->user_id) {
                abort(401);
            }
            $collection->scenes()->detach($scene);

            return response()->json($this->fetchSounds(null, $me));
        }
        public function createCollection(Request $request) {
            $me = \Auth::user();
            if(empty($me)) {
                abort(401);
            }
            $collectionData = [
            'user_id' => $me->id,
            'name' => $request->get('name'),
            'desc' => $request->get('desc',""),
            ];

            $scene = Collection::create($collectionData);

            return response()->json($this->fetchSounds(null, $me));
        }
        public function updateCollection(Request $request, Collection $collection) {
            $me = \Auth::user();
            if(empty($me) || $me->id != $collection->user_id) {
                abort(401, "Cannot modify collections you didn't create");
            }
            $collectionData = [
            'user_id' => $me->id,
            'name' => $request->get('name'),
            'desc' => $request->get('desc'),
            ];
            $sceneOrder = $request->get('scenes');
            \Log::info($sceneOrder);
            $i = 0;
            foreach($sceneOrder as $scene) {
                \DB::table('collection_scene')->where('scene_id', $scene['id'])->where('collection_id', $collection->id)->update(['order' => $i++]);
            }

            $collection->update($collectionData);

            return response()->json($this->fetchSounds(null, $me));
        }
        public function deleteCollection(Request $request, Collection $collection) {
            $me = \Auth::user();
            if(empty($me) || $me->id != $collection->user_id) {
                abort(401, "Cannot delete collections you didn't create");
            }

            $collection->delete();

            return response()->json($this->fetchSounds(null, $me));
        }
        public function createScene(Request $request, Collection $collection = null) {
            $me = \Auth::user();
            if(empty($me)) {
                abort(401);
            }
            $sceneData = [
            'user_id' => $me->id,
            'name' => $request->get('name'),
            'desc' => $request->get('desc',""),
            'img' => $request->get('img'),
            'fade_in' => $request->get('fade_in'),
            'fade_out' => $request->get('fade_out'),
            'volume' => $request->get('volume'),
            'scene_solo' => $request->get('scene_solo'),
            ];

            $scene = Scene::create($sceneData);
            if (!empty($collection)) $collection->scenes()->attach($scene);

            return response()->json($this->fetchSounds(null, $me));
        }
        public function updateScene(Request $request, Scene $scene) {
            $me = \Auth::user();
            if(empty($me) || $me->id != $scene->user_id) {
                abort(401, "Cannot modify scenes you didn't create");
            }
            $sceneData = [
            'user_id' => $me->id,
            'name' => $request->get('name'),
            'desc' => $request->get('desc'),
            'img' => $request->get('img'),
            'fade_in' => $request->get('fade_in'),
            'fade_out' => $request->get('fade_out'),
            'volume' => $request->get('volume'),
            'scene_solo' => $request->get('scene_solo'),
            ];

            $scene->update($sceneData);

            return response()->json($this->fetchSounds(null, $me));
        }
        public function deleteScene(Request $request, Scene $scene) {
            $me = \Auth::user();
            if(empty($me) || $me->id != $scene->user_id) {
                abort(401, "Cannot delete scenes you didn't create");
            }

            $scene->delete();

            return response()->json($this->fetchSounds(null, $me));
        }
        public function attachEffect(Request $request, Scene $scene, Effect $effect) {
            $me = \Auth::user();
            if(empty($me) || $me->id != $scene->user_id) {
                abort(401);
            }
            $scene->effects()->attach($effect);


            return response()->json($this->fetchSounds(null, $me));
        }
        public function detachEffect(Request $request, Scene $scene, Effect $effect) {
            $me = \Auth::user();
            if(empty($me) || $me->id != $scene->user_id) {
                abort(401);
            }
            $scene->effects()->detach($effect);


            return response()->json($this->fetchSounds(null, $me));
        }
        public function createEffect(Request $request, Effect $effect) {
            $me = \Auth::user();
            if(empty($me)) {
                abort(401);
            }
            $effectData = [
            'user_id' => $me->id,
            'name' => $request->get('name', "New Effect"),
            'desc' => $request->get('desc',""),
            'sounds' => $request->get('sounds', []),
            'volume' => $request->get('volume', 100),
            'pre_delay' => $request->get('pre_delay', 0),
            'loop' => $request->get('loop', 0),
            'delay_min' => $request->get('delay_min', 0),
            'delay_max' => $request->get('delay_max', 0),
            'optional' => $request->get('optional', 0),
            'seq' => $request->get('seq', 0)
            ];

            Effect::create($effectData);


            return response()->json($this->fetchSounds(null, $me));
        }
        public function updateEffect(Request $request, Effect $effect) {
            $me = \Auth::user();
            if(empty($me) || $me->id != $effect->user_id) {
                abort(401, "Cannot modify an effect you didn't create");
            }
            $effectData = [
            'name' => $request->get('name'),
            'desc' => $request->get('desc'),
            'sounds' => $request->get('sounds'),
            'volume' => $request->get('volume'),
            'pre_delay' => $request->get('pre_delay'),
            'loop' => $request->get('loop'),
            'delay_min' => $request->get('delay_min'),
            'delay_max' => $request->get('delay_max'),
            'optional' => $request->get('optional'),
            'seq' => $request->get('seq')
            ];
            $effect->update($effectData);

            return response()->json($this->fetchSounds(null, $me));
        }
        public function deleteEffect(Request $request, Effect $effect) {
            $me = \Auth::user();
            if(empty($me) || $me->id != $effect->user_id) {
                abort(401, "Cannot delete an effect you didn't create");
            }

            $effect->delete();

            return response()->json($this->fetchSounds(null, $me));
        }
        public function soundSearch(Request $request, User $user) {
            $me = \Auth::user();
            if(empty($me)) {
                abort(401);
            }
            $search = $request->validate([
            'search'  => 'string|min:2',
            ])['search'];
            $sounds = Sound::whereIn('user_id', [1, $user->id])->where(function($q) use($search){
                $q->where('name', 'LIKE', "%$search%")
                ->orWhere('tags', 'LIKE', "%$search%");
            })->get();

            return response()->json($sounds);
        }
        public function fetchSounds(Request $request = null, User $user) {
            // $me = \Auth::user();
            // if(empty($me)) {
            //     abort(401);
            // }
            $collections = $user->Collections()->with('scenes.effects')->get();
            $scenes = Scene::whereIn('user_id', [1, $user->id])->with('effects')->get();
            $effects = Effect::whereIn('user_id', [1, $user->id])->get();
            \Log::info($collections);
                if ($request) return response()->json(['collections' => $collections, 'scenes' => $scenes, 
            'effects' => $effects]);
            \Log::info($collections);
            return ['collections' => $collections, 'scenes' => $scenes, 
            'effects' => $effects];
        }
        public function createSound(Request $request, Effect $effect) {
            $me = \Auth::user();
            if(empty($me) || $effect->user_id !== $me->id) abort(401);
            $request->validate([
            'file' => 'required|mimes:mp3,ogg,wav|max:32288'
            ]);

            $fileName = $request->file->getClientOriginalName();
            $ext = \File::extension($fileName);
            $sound = Sound::firstOrCreate(['user_id' => $me->id, 'name' => $request->get('name'), 'tags' => $request->get('tags'), 'ext' => $ext], ['duration' => $request->get('duration')]);

            \Storage::disk('s3')->makeDirectory('sounds/' . $me->id, 'public');
            \Storage::disk('s3')->put('sounds/' . $me->id . '/' . $sound->id . '.' . $sound->ext, file_get_contents($request->file('file')), 'public');

            return response()->json(['message' => "Sound Uploaded", 'sound' => $sound->refresh()]);
        }
        public function getSound(Request $request, Sound $sound) {
            $me = \Auth::user();
            if(empty($me)) {
                abort(401);
            }
            return response()->make(
            \Storage::disk('s3')->get('sounds/' . $sound->user_id . '/' . $sound->id . '.' . $sound->ext),
            200,
            ['Content-Type' => 'audio/'. $sound->ext]
        );
        }
    }