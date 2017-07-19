<?php

namespace App\Http\Controllers\Container;

use App\Container;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ContainerContainerStateController extends ApiController
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function index(Container $container)
    {
        $containerState = $container->containerStates;

        foreach ($containerState as $state) {  
            $state->states;
        }

        return $this->showAll($containerState);
    }
}
