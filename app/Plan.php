<?php

namespace App;

use App\ContainerPlan;
use App\FrecuencyType;
use App\Task;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
    	'frecuency',
    	'date_start',
    	'date_end',
    	'description',
    	'frecuency_type_id',
    	'task_id'
    ];

    protected $with = [
    'frecuencyType',
    'task'
    ];

    public function frecuencyType(){
    	return $this->belongsTo(FrecuencyType::class);
    }    
    public function task(){
    	return $this->belongsTo(Task::class);
    }
    public function containerPlans(){
        return $this->hasMany(ContainerPlan::class);
    }
}
