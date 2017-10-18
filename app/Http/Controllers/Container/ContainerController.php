<?php

namespace App\Http\Controllers\Container;

use App\Alert;
use App\Container;
use App\ContainerState;
use App\Http\Controllers\ApiController;
use App\Zone;
use Illuminate\Http\Request;

class ContainerController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $containers = Container::All();
        foreach ($containers as $container) {
           $container->latestContainerStates->states;
        }

        return $this->showAll($containers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =[ 
                    'mac' => "required | regex:^([0-9A-Fa-f]{2}[:-]){5}([0-9A-Fa-f]{2})$^ | unique:containers", // Valido que sea una MAC valida
                ];
        $this->validate($request, $rules);
        $container = new Container();
        $container->mac = $request->mac;
        $container->zone_id = 1; //indica sin zona
        $container->save();

        $containerState = new ContainerState();
        $containerState->state_type = ContainerState::ESTADO_ALERTA;
        $containerState->container_id = $container->id;
        $containerState->save();
        $alert = new Alert();
        $alert->container_state_id = $containerState->id;
        $alert->alert_type_id = 1; //1 Indica Nuevo
        $alert->save();

        return $this->showOne($container,201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function show(Container $container)
    {
        return $this->showOne($container);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Container $container)
    {
        $rules = [
        'zone_id' => 'required',
        'green' => 'required',
        'code' => 'required'
        ];

        $this->validate($request,$rules); 

        $container->zone_id = $request->zone_id;
        $container->green = $request->green;
        $container->code = $request->cod;

        $container->save();

        return $this->showOne($container);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function destroy(Container $container)
    {
        $container->delete();

        return $this->showOne($container);
    }
}
