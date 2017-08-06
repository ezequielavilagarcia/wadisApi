<?php

namespace App\Http\Controllers\AlertType;

use App\AlertType;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class AlertTypeController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alertTypes = AlertType::All();

        return $this->showALl($alertTypes);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AlertType  $alertType
     * @return \Illuminate\Http\Response
     */
    public function show(AlertType $alertType)
    {
               return $this->showOne($alertType);

    }
}
