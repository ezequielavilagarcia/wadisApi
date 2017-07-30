<?php

namespace App\Http\Controllers\Container;

use App\Container;
use App\ContainerPlan;
use App\Http\Controllers\ApiController;
use App\Plan;
use Illuminate\Http\Request;

class ContainerContainerPlanController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Container $container)
    {
        $containerPlans = $container->containerPlans;

        return $this->showAll($containerPlans);
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
    public function store(Container $container, Plan $plan, Request $request)
    {
        $containerPlan = new ContainerPlan();
        $containerPlan->container_id = $container->id;
        $containerPlan->plan_id = $plan->id;
        $containerPlan->save();

        return $this->showOne($containerPlan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function show(Container $container)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function edit(Container $container)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Container  $container
     * @return \Illuminate\Http\Response
     */
    public function destroy(Container $container)
    {
        //
    }
}
