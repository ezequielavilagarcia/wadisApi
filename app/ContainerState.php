<?php

namespace App;

use App\Alert;
use App\Container;
use App\Fullness;
use App\Location;
use Illuminate\Database\Eloquent\Model;

class ContainerState extends Model
{
	const ESTADO_LLENADO = 1;
	const ESTADO_LOCACION = 2;
	const ESTADO_ALERTA = 3;

    protected $fillable = [
        'state_type',
        'container_id',
    ];
    protected $hidden = [
    	'id',
    	'container_id',
    ];

    

    public function container()
    {
    	return $this->belongsTo(Container::class);
    }

    public function states()
    {
        if($this->state_type == 1)
        {
            return $this->hasOne(Fullness::class);
        }        
        if($this->state_type == 2)
        {
            return $this->hasOne(Location::class);
        }        
        if($this->state_type == 3)
        {
            return $this->hasOne(Alert::class);
        }
    }
}
