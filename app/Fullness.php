<?php

namespace App;

use App\ContainerState;
use Illuminate\Database\Eloquent\Model;

class Fullness extends Model
{
	public $timestamps = false;
	public $primaryKey  = "container_state_id";

    protected $fillable = [
    	'value',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
    	'container_state_id',
    ];
    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'containerState',
    ];

    public function ContainerState()
    {
        return $this->belongsTo(ContainerState::class);
    }
}
