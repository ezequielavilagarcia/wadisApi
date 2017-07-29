<?php

namespace App\Http\Controllers\FrecuencyType;

use App\FrecuencyType;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class FrecuencyTypeController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $frecuencyTypes = FrecuencyType::All();
        return $this->showAll($frecuencyTypes);
    }
}
