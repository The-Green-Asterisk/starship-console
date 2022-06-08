<?php

namespace App\Http\Controllers;

use App\Events\HpUpdate;
use App\Http\Requests\StoreSystemRequest;
use App\Http\Requests\UpdateSystemRequest;
use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
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
     * @param  \App\Http\Requests\StoreSystemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSystemRequest $request)
    {
        $system = System::create([
            'name' => $request->name,
            'description' => $request->description,
            'division_action' => $request->division_action,
            'max_hp' => $request->max_hp,
            'current_hp' => $request->max_hp,
            'starship_id' => $request->starship_id,
        ]);

        $system->divisions()->attach($request->division_id);

        $system->save();

        return back()->with('success', 'New system installed.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\System  $system
     * @return \Illuminate\Http\Response
     */
    public function show(System $system)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\System  $system
     * @return \Illuminate\Http\Response
     */
    public function edit(System $system)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSystemRequest  $request
     * @param  \App\Models\System  $system
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSystemRequest $request)
    {
        $system = System::find($request->system_id);

        $system->update([
            'name' => $request->name,
            'description' => $request->description,
            'division_action' => $request->division_action,
            'max_hp' => $request->max_hp,
            'current_hp' => $request->current_hp > $request->max_hp ? $request->max_hp : $request->current_hp,
        ]);

        $system->save();

        return back()->with('success', 'System updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\System  $system
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        System::where('id', $request->system)->first()->delete();

        return back()->with('success', 'System removed.');
    }

    public function quickFix(System $system, $quickFix)
    {
        $system = System::find($system->id);
        $system->current_hp += ($quickFix + auth()->user()->characters->where('is_active', true)->first()->engineering_mod);
        $system->save();

        $response[] = [
            'systemId' => $system->id,
            'hp' => $system->getHpPercentage(),
            'current' => $system->current_hp
        ];

        HpUpdate::dispatch($response);
    }
}
