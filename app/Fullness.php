<?php

namespace App;

use App\ContainerState;
use Illuminate\Database\Eloquent\Model;

class Fullness extends Model
{
    const LIMITE_RECOLECTAR = 75;
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
    public function ContainerState()
    {
        return $this->belongsTo(ContainerState::class);
    }
}
