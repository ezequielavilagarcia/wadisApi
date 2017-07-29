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



    public function Plans()
    {
    	return $this->hasMany(Plan::cLass);
    }
}
