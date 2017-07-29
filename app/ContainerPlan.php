<?php

namespace App;

use App\Plan;
use Illuminate\Database\Eloquent\Model;

class ContainerPlan extends Model
{
    protected $fillable = [
    	'container_id',
    	'plan_id'
    ];

    protected $hidden = [
    	'container_id',
    	'plan_id'
    ];

    protected $with = [
    	'container',
    	'plan'
    ];

    public function container(){
    	return $this->belongsTo(Container::class);
    }

    public function plan(){
    	return $this->belongsTo(Plan::class);
    }
}
