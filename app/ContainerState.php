<?php

namespace App;

use App\Container;
use Illuminate\Database\Eloquent\Model;

class ContainerState extends Model
{
	const ESTADO_LLENADO = '1';
	const ESTADO_LOCACION = '2';
	const ESTADO_ALERTA = '3';

    protected $fillable = [
    	'state_type',
    	'container_id',
    ];

    public function container()
    {
    	return $this->belongsTo(Container::class);
    }
}
