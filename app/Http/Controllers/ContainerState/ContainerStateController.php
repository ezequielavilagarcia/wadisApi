<?php

namespace App\Http\Controllers\ContainerState;

use App\ContainerState;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class ContainerStateController extends ApiController
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
     * @param  \App\ContainerState  $containerState
     * @return \Illuminate\Http\Response
     */
    public function show(ContainerState $cont)
    {
        return $this->showOne($cont);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ContainerState  $containerState
     * @return \Illuminate\Http\Response
     */
    public function edit(ContainerState $containerState)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ContainerState  $containerState
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContainerState $containerState)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ContainerState  $containerState
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContainerState $containerState)
    {
        //
    }
}
