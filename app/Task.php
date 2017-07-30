<?php

namespace App;

use App\ContainerTask;
use App\Plan;
use App\TaskType;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    const RECOLECCION = '1';
    const LIMPIEZA = '2';
    const MANTENIMIENTO = '3';
    const URGENCIA = '4';

    protected $fillable = [
    'task_type_id',
    'user_profile_id'
    ];

    protected $hidden = [
    'task_type_id',
    'user_profile_id'
    ];

    protected $with = [
    'taskType',
    'userProfile'
    ];
    public function taskType(){
    	return $this->belongsTo(TaskType::class);
    }    
    public function userProfile(){
    	return $this->belongsTo(UserProfile::class);
    }
    public function plans(){
        return $this->hasMany(Plan::class);
    }    
    public function containerTasks(){
        return $this->hasMany(ContainerTask::class);
    }
}
