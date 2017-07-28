<?php

namespace App;

use App\tasks;
use Illuminate\Database\Eloquent\Model;

class TaskType extends Model
{
    protected $fillable = [
    'name',
    'description'
    ];

    public function tasks(){
    	$this->hasMany(task::class);
    }
}
