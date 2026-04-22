<?php

use App\Http\Controllers\HeroController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\QuestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/heroes',[HeroController::class,'store']);
Route::get('/heroes',[HeroController::class,'index']);
Route::put('/heroes/{azonosito}/levelup',[HeroController::class,'levelUp']);
Route::put('/heroes/{azonosito}/kill',[HeroController::class,'kill']);

Route::post('/items',[ItemController::class,'store']);
Route::delete('/items/{azonosito}',[ItemController::class, 'destroy']);

Route::post('/quests',[QuestController::class,'store']);
Route::put('/quest/{azonosito}/completed',[QuestController::class,'update']);