<?php

namespace App\Http\Controllers\ContainerState;

use App\Container;
use App\ContainerState;
use App\ContainerTask;
use App\Fullness;
use App\Http\Controllers\ApiController;
use App\Task;
use Illuminate\Http\Request;

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
        //verificamos si exuste una tarea creada para el contenedor
        $containerTask = ContainerTask::           
                where('date_execution','<=',date('Y-m-d'))
                ->whereNull('date_done')
                ->get();
        //  Si el valor requiere recoleccion y no existe una tarea de recoleccion
        if($request->value >= Fullness::LIMITE_RECOLECTAR)
        {   
            if($containerTask->count() == 0) 
            {     
        
                $containerTask = new ContainerTask();
                $containerTask->container_id = $container->id;
                $containerTask->date_execution = date('Y-m-d');
                $containerTask->task_id = Task::RECOLECCION;
                $user = $container->zone->user;
                if($user){
                    //Deberiamos verificar a futuro si el perfil del usuario puede realizar la tarea
                    $containerTask->user_id = $user->id;
                }
                $containerTask->save();
            }  
        }
        else{
            //Si es menor 
            if($containerTask)
            {
                $containerTask[0]->date_done = date('Y-m-d');
                $containerTask[0]->save();
            }
        }

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
