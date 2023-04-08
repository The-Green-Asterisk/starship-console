<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCargoItemRequest;
use App\Http\Requests\UpdateCargoItemRequest;
use App\Models\CargoItem;
use App\Models\Starship;

class CargoItemController extends Controller
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
     * @param  \App\Http\Requests\StoreCargoItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCargoItemRequest $request)
    {
        $cargoItem = new CargoItem();
        $cargoItem->starship()->associate(Starship::find($request->starship_id));
        $cargoItem->name = strip_tags(substr($request->name, 0, 255));
        $cargoItem->quantity = $request->quantity > 2147483647 ? 2147483647 : $request->quantity;
        $cargoItem->description = strip_tags(substr($request->description, 0, 65535));
        $cargoItem->save();

        return $cargoItem->toJson();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CargoItem  $cargoItem
     * @return \Illuminate\Http\Response
     */
    public function show(CargoItem $cargoItem)
    {
        return $cargoItem->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CargoItem  $cargoItem
     * @return \Illuminate\Http\Response
     */
    public function edit(CargoItem $cargoItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCargoItemRequest  $request
     * @param  \App\Models\CargoItem  $cargoItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCargoItemRequest $request, CargoItem $cargoItem)
    {
        $cargoItem->name = strip_tags(substr($request->name, 0, 255));
        $cargoItem->quantity = $request->quantity > 2147483647 ? 2147483647 : $request->quantity;
        $cargoItem->description = strip_tags(substr($request->description, 0, 65535));
        $cargoItem->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CargoItem  $cargoItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CargoItem $cargoItem)
    {
        $cargoItem->delete();
    }
}
