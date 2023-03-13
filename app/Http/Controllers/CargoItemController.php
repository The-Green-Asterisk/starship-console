<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCargoItemRequest;
use App\Http\Requests\UpdateCargoItemRequest;
use App\Models\CargoItem;

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
        $validator = $request->validate([
            'name' => 'required|unique:cargo_items,name|max:255'
        ]);

        if ($validator->fails()) {
            return $validator->errors()->toJson();
        } else {
            $cargoItem = CargoItem::create($request->all());
            return $cargoItem->toJson();
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CargoItem  $cargoItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(CargoItem $cargoItem)
    {
        //
    }
}
