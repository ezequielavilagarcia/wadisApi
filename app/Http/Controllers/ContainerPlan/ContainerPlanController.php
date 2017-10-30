<?php

namespace App\Http\Controllers\ContainerPlan;

use App\ContainerPlan;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContainerPlanController extends ApiController
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ContainerPlan  $containerPlan
     * @return \Illuminate\Http\Response
     */
    public function show(ContainerPlan $containerPlan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContainerPlan  $containerPlan
     * @return \Illuminate\Http\Response
     */
    public function edit(ContainerPlan $containerPlan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContainerPlan  $containerPlan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContainerPlan $containerPlan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContainerPlan  $containerPlan
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContainerPlan $containerPlan)
    {
        $containerPlan->delete();
        return $this->showOne($containerPlan);
    }
}
