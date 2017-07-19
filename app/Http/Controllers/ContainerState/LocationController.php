<?php

namespace App\Http\Controllers\ContainerState;

use App\Location;
use App\Container;
use App\ContainerState;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class LocationController extends ApiController
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Defino reglas de validacion
        $rules = [
            'mac' => 'required',
            'geo_x' => 'required | min:1',
            'geo_y' => 'required | min:1',
        ];
        //Aplico las reglas al request
        $this->validate($request, $rules);

        $container = Container::where('mac', $request->mac)->firstOrFail();

        $containerState = new ContainerState();

        $containerState->state_type = ContainerState::ESTADO_LOCACION;
        $containerState->container_id = $container->id;
        $containerState->save();

        $state = new Location();
        $state->container_state_id = $containerState->id;
        $state->geo_x = $request->geo_x;
        $state->geo_y = $request->geo_y;
        $state->save();

        return $this->showOne($state,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }
}
