<?php

namespace App;

use App\Task;
use App\User;
use App\Container;
use Illuminate\Database\Eloquent\Model;

class ContainerTask extends Model
{
    protected $fillable = [
		'date_done', //indica la fecha en que se realizo la tarea, si es null, no fue ralizada
		'date_execution', //indica la fecha que debe realizarse la tarea
		'user_id', // Indica el usuario que realizo la tarea, para ello utilizar RFID, sirve para mantener el historial de quien realizo que tarea por si cambia de zona el usuario.
		'task_id', //indica la tarea a realizarse
		'container_id' //Indica sobre que contenedor se realizará o se realizo la tarea
    ];

    protected $hidden = [
	    'user_id',
	    'task_id',
	    'container_id'
    ];

    protected $with =[
    	'user',
    	'task',
    	'container'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function task(){
    	return $this->belongsTo(Task::class);
    }
    public function container(){
    	return $this->belongsTo(Container::class);
    }
}
