<?php

namespace App;

use App\ContainerState;
use Illuminate\Database\Eloquent\Model;

class Fullness extends Model
{
	public $timestamps = false;
	public $id = false;

    protected $fillable = [
    	'value',
    	'container_state_id',
    ];
    protected $hidden = [
    	'id',
    ];


    public function ContainerState()
    {
        return $this->hasOne(ContainerState::class);
    }
}
