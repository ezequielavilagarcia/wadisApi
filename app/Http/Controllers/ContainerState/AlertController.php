<?php

namespace App\Http\Controllers\ContainerState;

use App\Alert;
use App\AlertType;
use App\Container;
use App\ContainerState;
use App\ContainerTask;
use App\Http\Controllers\ApiController;
use App\Task;
use Illuminate\Http\Request;

class AlertController extends ApiController
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
            'alert_type' => 'required',
        ];
        //Aplico las reglas al request
        $this->validate($request, $rules);

        $container = Container::where('mac', $request->mac)->firstOrFail();

        $containerState = new ContainerState();

        $containerState->state_type = ContainerState::ESTADO_ALERTA;
        $containerState->container_id = $container->id;
        $containerState->save();

        $state = new Alert();
        $state->container_state_id = $containerState->id;
        $state->alert_type_id = $request->alert_type;
        $state->save();

        switch ($request->alert_type) {
            case AlertType::INCENDIO:
                    $task_id = Task::INCENDIO;
                break;            
            case AlertType::VOLCADO:
                    $task_id = Task::VOLCADO;
                break;
        }

        //verificamos si existe una tarea creada para el contenedor del tipo del alerta
        if(isset($task_id)){         
            $containerTasks = ContainerTask::           
                    where(
                            [
                                [
                                    'date_execution','<=',date('Y-m-d')
                                ],
                                [
                                    'task_id','=',$task_id
                                ],
                            ]
                        )
                    ->whereNull('date_done')
                    ->get();
            //  Si no existe una tarea del mismo tipo 
            if($containerTasks->count() == 0) 
            {     
                $containerTask = new ContainerTask();
                $containerTask->container_id = $container->id;
                $containerTask->date_execution = date('Y-m-d');
                $containerTask->task_id = $task_id;
                if($task_id == Task::INCENDIO){
                    $user = $container->zone->userUrgencia;
                }else{
                    $user = $container->zone->userMantenimiento;                    
                }
                if($user){
                    $containerTask->user_id = $user->id;
                }
                $containerTask->save();
            }  
        }
        return $this->showOne($containerState,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function show(Alert $alert)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function edit(Alert $alert)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alert $alert)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alert  $alert
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alert $alert)
    {
        //
    }
}
