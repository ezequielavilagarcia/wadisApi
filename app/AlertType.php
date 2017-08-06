<?php

namespace App;

use App\Alert;
use Illuminate\Database\Eloquent\Model;

class AlertType extends Model
{
    const NUEVO = 1;
    const VOLCADO = 2;
    const INCENDIO = 3;
    const SIN_SENIAL = 4;
    
    public $timestamps = false;
    protected $fillable = [
    	'name',
    ];    



    public function Alerts()
    {
    	return $this->hasMany(Alert::cLass);
    }
}
