<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreatureController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\WorldController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'api'], function ($router) {
	Route::post('creature', [CreatureController::class, 'addCreature']);
	Route::put('creature', [CreatureController::class, 'updateCreature']);
	Route::delete('creature', [CreatureController::class, 'deleteCreature']);
    Route::get('/region/{region}/edit-map', [WorldController::class, 'mapGenerator']);
    // Route::get('creatures/{term?}', [CreatureController::class, 'getCreatures']);
    Route::post('creatures/{term?}', [CreatureController::class, 'getCreatures']);

	Route::get('campaigns/{term?}', [StoryController::class, 'getCampaigns']);
	Route::get('campaign', [StoryController::class, 'getCampaign']);
	Route::post('map', [StoryController::class, 'getMap']);

    Route::post('world/create', [WorldController::class, 'create']);
    Route::get('world/{world}', [WorldController::class, 'read']);
    Route::delete('world/{world}', [WorldController::class, 'delete']);
    Route::get('world/fr/{region}', [WorldController::class, 'getWorldFromRegion']);
    Route::post('world/{world}/region/add', [WorldController::class, 'addRegion']);
    Route::delete('region/{region}', [WorldController::class, 'deleteRegion']);
    Route::put('region/{region}', [WorldController::class, 'saveRegion']);
    Route::post('region/{region}', [WorldController::class, 'saveRegion']);
    Route::get('region/{region}', [WorldController::class, 'getRegion']);
    Route::get('region/{region}/seed', [WorldController::class, 'seedRegion']);
    Route::get('region/{region}/clear', [WorldController::class, 'clearRegion']);
    Route::get('region/{region}/age/{years}', [WorldController::class, 'ageRegion']);
    Route::get('region/{region}/npcs', [WorldController::class, 'getNpcs']);
    Route::get('region/{region}/npc-list', [WorldController::class, 'getNpcList']);
    Route::post('region/{region}/upload-map', [WorldController::class, 'uploadMap']);
    Route::put('npc/{npc}/generate-features', [WorldController::class, 'generateFeatures']);
    Route::put('region/{region}/poi', [WorldController::class, 'updatePOI']);
    Route::put('region/{region}/svg', [WorldController::class, 'updateSVG']);
    Route::put('npc/{npc}', [WorldController::class, 'updateNpc']);
    Route::get('npc/{npc}', [WorldController::class, 'getNpc']);
    Route::get('region/{region}/{type}/{i}', [WorldController::class, 'getPOI']);
    Route::post('region/{region}/{type}/{i}/{npc}', [WorldController::class, 'attachNPC']);
    Route::post('region/{region}/create-poi', [WorldController::class, 'createPOI']);
    Route::delete('region/{region}/{type}/{i}/{npc}', [WorldController::class, 'detachNPC']);

    // Route::get('user/{user}/sounds', [SoundController::class, 'attachScene']);
    // Route::get('sound/', [SoundController::class, 'detachScene']);
    // Route::post('collection/', [SoundController::class, 'createCollection']);
    // Route::get('sound/', [SoundController::class, 'updateCollection']);
    // Route::get('sound/', [SoundController::class, 'deleteCollection']);
    // Route::get('sound/', [SoundController::class, 'createScene']);
    // Route::get('sound/', [SoundController::class, 'updateScene']);
    // Route::get('sound/', [SoundController::class, 'deleteScene']);
    // Route::get('sound/', [SoundController::class, 'attachEffect']);
    // Route::get('sound/', [SoundController::class, 'detachEffect']);
    // Route::get('sound/', [SoundController::class, 'createEffect']);
    // Route::get('sound/', [SoundController::class, 'updateEffect']);
    // Route::get('sound/', [SoundController::class, 'deleteEffect']);
    // Route::get('sound/', [SoundController::class, 'soundSearch']);
    Route::get('user/{user}/sounds', [SoundController::class, 'fetchSounds']);
    // Route::get('sound/', [SoundController::class, 'createSound']);
    // Route::get('sound/', [SoundController::class, 'getSound']);

});