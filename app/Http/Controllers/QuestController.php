<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use Illuminate\Http\Request;
use App\Models\Hero;

class QuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $hero = Hero::find($request->hero_id);

        if (!$hero) {
            return response()->json('Nincs ilyen azonosítóval hős az adatbázisban!',400,options:JSON_UNESCAPED_UNICODE);
        }

        if ($hero->alive == false) {
            return response()->json('A hős nem él, még egyszer nem lehet eltenni láb alól!',400,options:JSON_UNESCAPED_UNICODE);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'reward_gold' => 'required|integer|min:1'
        ]);

        $hero->quests()->create($validated);

        return response()->json('A quest hozzá lett rendelve a hőshöz!',201,options:JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     */
    public function show(Quest $quest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $quest)
    {
        $quest = Quest::find($quest);

        if (!$quest) {
            return response()->json('Nincs ilyen azonosítóval küldetés az adatbázisban!',400,options:JSON_UNESCAPED_UNICODE);
        }

        if ($quest->completed){
            return response()->json('A küldetést már teljesítette a hős!',409,options:JSON_UNESCAPED_UNICODE);
        }
        else {
            $quest->completed = true;
            $quest->save();
        }
        return response()->json('Küldetés sikeresen teljesítve!',200,options:JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $quest)
    {
        //
    }
}
