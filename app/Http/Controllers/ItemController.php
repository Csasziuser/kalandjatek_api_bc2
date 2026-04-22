<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Models\Hero;

class ItemController extends Controller
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
            'name' => 'required|string|max:50',
            'type' => 'required|string|max:50',
            'power' => 'required|integer|between:1,100'
        ]);

        $hero->items()->create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $item)
    {
        //
    }
}
