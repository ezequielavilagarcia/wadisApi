<?php

namespace App;

use App\ContainerState;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    public $timestamps = false;
    public $primaryKey  = "container_state_id";

    protected $fillable = [
        'geo_x',
        'geo_y',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'container_state_id',
    ];
    public function ContainerState()
    {
        return $this->belongsTo(ContainerState::class);
    }
}
