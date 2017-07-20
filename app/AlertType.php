<?php

namespace App;

use App\Alert;
use Illuminate\Database\Eloquent\Model;

class AlertType extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'name',
    ];


    public function Alerts()
    {
    	return $this->hasMany(Alert::cLass);
    }
}
