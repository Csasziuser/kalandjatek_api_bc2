<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $heroes = Hero::with('items','quests')->get();
        return response()->json($heroes, options:JSON_UNESCAPED_UNICODE);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50|unique:heroes,name',
            'class' => 'required|string|max:50',
            'level' => 'sometimes|integer|between:1,20'
        ]);
        try {
            Hero::create($validated);
            // Hero::created([
            //     'name' => $request->name,
            //     'class' => $request->class,
            //     'level' => $request->level
            // ])
            return response()->json('Hős sikeresen rögzítve!',201,options:JSON_UNESCAPED_UNICODE);

        } catch (\Throwable $th) {
            return response()->json('Szerverhiba!',500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function levelUp(string $azonosito)
    {
        $hero = Hero::find($azonosito);

        if (!$hero) {
            return response()->json('Nincs ilyen azonosítóval hős az adatbázisban!',400,options:JSON_UNESCAPED_UNICODE);
        }

        if ($hero->alive == false) {
            return response()->json('A hős nem él, nem lehet szintet lépnie!',400,options:JSON_UNESCAPED_UNICODE);
        }

        if ($hero->level == 20) {
            return response()->json('A hős elérte a maximális szintet!',400,options:JSON_UNESCAPED_UNICODE);
        }

        $hero->level++; 
        $hero->save();
        return response()->json('A hős szintet lépett!',200,options:JSON_UNESCAPED_UNICODE);

    }

    /**
     * Update the specified resource in storage.
     */
    public function kill(string $azonosito)
    {
        $hero = Hero::find($azonosito);

        if (!$hero) {
            return response()->json('Nincs ilyen azonosítóval hős az adatbázisban!',400,options:JSON_UNESCAPED_UNICODE);
        }

        if ($hero->alive == false) {
            return response()->json('A hős nem él, még egyszer nem lehet eltenni láb alól!',400,options:JSON_UNESCAPED_UNICODE);
        }

        $hero->alive = false;
        $hero->save();
        return response()->json('A hős elpatkolt!',200,options:JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $hero)
    {
        //
    }
}
