<?php

namespace App;

use App\Plan;
use Illuminate\Database\Eloquent\Model;

class FrecuencyType extends Model
{
    public $timestamps = false;
    protected $fillable = [
    	'name',
    ];    

    protected $hidden = [
    	'id',
    ];


    public function Plans()
    {
    	return $this->hasMany(Plan::cLass);
    }
}
