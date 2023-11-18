<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCharacterRequest;
use App\Http\Requests\UpdateCharacterRequest;
use App\Models\Character;
use App\Models\Division;
use App\Models\Starship;
use App\Notifications\Notify;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCharacterRequest $request)
    {
        $character = new Character();
        $character->user_id = auth()->user()->id;
        $character->name = $request->name;
        $character->starship()->associate(Starship::find($request->starship_id));
        $character->engineering_mod = $request->engineering_mod;
        $character->save();
        $this->makeActive($character);

        return back()->with('success', 'Character created!');
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Character $character)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Character $character)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Models\Character  $character
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCharacterRequest $request)
    {
        Character::where('id', $request->character_id)->update([
            'name' => $request->name,
            'engineering_mod' => $request->engineering_mod,
            'starship_id' => $request->starship_id,
        ]);

        return back()->with('success', 'Character updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Character $character)
    {
        $character = Character::find($character->id);
        $character->divisions()->detach();
        $character->delete();
        foreach (auth()->user()->starships as $starship) {
            if ($starship->captain_id == $character->id) {
                $starship->captain_id = null;
                $starship->save();
            }
        }
        if (auth()->user()->characters->count() > 0) {
            $this->makeActive(auth()->user()->characters->first());
        }

        return back()->with('success', 'Character deleted!');
    }

    public function makeActive(Character $character)
    {
        for ($i = 0; $i < count(auth()->user()->characters); $i++) {
            auth()->user()->characters[$i]->is_active = false;
            auth()->user()->characters[$i]->save();
        }
        $char = Character::find($character->id);
        $char->is_active = true;
        $char->save();

        return back()->with('success', $char->name.' activated!');
    }

    public function divisionSelect(Character $character, Division $division)
    {
        $character = Character::find($character->id);

        $character->divisions()->toggle($division->id);

        $character->save();

        $character->user->notify(new Notify(
            "$character->name has been ".($character->divisions()->find($division) ? 'assigned to ' : 'unassigned from ')."$division->name aboard the ".$character->starship->name.'.',
            $character->user->is_dm ? "/dm-dashboard/$character->starship_id" : "/dashboard/$character->starship_id",
            $character->user->id
        ));
        if ($character->user_id != $character->starship->dm_id) {
            $character->starship->dm->notify(new Notify(
                "$character->name has been ".($character->divisions()->find($division) ? 'assigned to ' : 'unassigned from ')."$division->name aboard the ".$character->starship->name.'.',
                "/dm-dashboard/$character->starship_id",
                $character->starship->dm_id
            ));
        }
    }
}
