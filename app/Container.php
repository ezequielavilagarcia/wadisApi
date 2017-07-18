<?php

namespace App;

use App\ContainerState;
use Illuminate\Database\Eloquent\Model;

class Container extends Model
{
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

    public function containerStates()
    {
    	return $this->hasMany(ContainerState::class);
    }
}
