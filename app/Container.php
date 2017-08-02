<?php

namespace App;

use App\ContainerPlan;
use App\ContainerState;
use App\ContainerTask;
use App\Zone;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Container extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

	const CONTENEDOR_RECICLABLE = "1";
	const CONTENEDOR_NO_RECICLABLE = "0";	

	const CONTENEDOR_DISPONIBLE = "1";
	const CONTENEDOR_NO_DISPONIBLE = "0";
    protected $fillable = [
        'code',
        'green',
        'mac',
        'zone_id',
        'status',
    ];   

   /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'zone',
        'latestLocation'
    ];


    public function containerStates()
    {
    	return $this->hasMany(ContainerState::class);
    }

    public function latestContainerStates()
    {
        return $this->hasOne(ContainerState::class)->latest();
    }    
    public function latestLocation()
    {
        return $this->hasOne(ContainerState::class)->where('state_type',ContainerState::ESTADO_LOCACION)->join('locations', 'container_states.id', '=', 'locations.container_state_id')->latest();
    }

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function containerTasks()
    {
        return $this->hasMany(ContainerTask::class);
    }    
    public function containerPlans()
    {
        return $this->hasMany(ContainerPlan::class);
    }
}
