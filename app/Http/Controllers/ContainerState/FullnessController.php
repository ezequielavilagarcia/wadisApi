<?php

namespace App\Http\Controllers\ContainerState;

use App\Container;
use App\ContainerState;
use App\Fullness;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class FullnessController extends ApiController
{

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
            'value' => 'required | integer',
        ];
        //Aplico las reglas al request
        $this->validate($request, $rules);

        $container = Container::where('mac', $request->mac)->firstOrFail();

        $containerState = new ContainerState();

        $containerState->state_type = ContainerState::ESTADO_LLENADO;
        $containerState->container_id = $container->id;
        $containerState->save();

        $fullness = new Fullness();
        $fullness->container_state_id = $containerState->id;
        $fullness->value = $request->value;
        $fullness->save();

        return $this->showOne($fullness,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fullness  $fullness
     * @return \Illuminate\Http\Response
     */
    public function show(Fullness $fullness)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fullness  $fullness
     * @return \Illuminate\Http\Response
     */
    public function edit(Fullness $fullness)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fullness  $fullness
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fullness $fullness)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fullness  $fullness
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fullness $fullness)
    {
        //
    }
}
