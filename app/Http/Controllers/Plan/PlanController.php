<?php

namespace App\Http\Controllers\Plan;

use App\Plan;
use App\Task;
use App\FrecuencyType;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

class PlanController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::All();

        return $this->showAll($plans);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return $this->showOne($plan);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'frecuency' => 'required | int',
            'date_start' => 'required | date',
            'date_end' => 'date',
            'description' => 'required',
            'frecuency_type_id' => 'required | int',
            'task_id' => 'required | int'
        ];

        $this->validate($request,$rules);

        $frecuencyType = FrecuencyType::where('id',$request->frecuency_type_id)->firstOrFail();
        $task = Task::where('id',$request->task_id)->firstOrFail();

        $plan = new Plan();
        $plan->frecuency = $request->frecuency;
        $plan->date_start = $request->date_start;
        $plan->date_end = $request->date_end;
        $plan->description = $request->description;
        $plan->frecuency_type_id = $request->frecuency_type_id;
        $plan->task_id = $request->task_id;
        $plan->save();

        return $this->showOne($plan);

    }
    
    public function GetPlanByDate(Request $request){
        $rules = [
            'year' => 'required | int',
            'month' => 'required'
        ];
        
        $this->validate($request,$rules);

        $plans= Plan::
            whereMonth('date_start','<=',$request->month)
            ->whereYear('date_start','=',$request->year)
            ->whereNull('date_end')
            ->get();

        return $this->showAll($plans);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
