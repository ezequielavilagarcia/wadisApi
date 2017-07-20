<?php

namespace App;

use App\AlertType;
use App\ContainerState;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    public $timestamps = false;
    public $primaryKey  = "container_state_id";

    protected $fillable = [
        'alert_type_id',
        'container_state_id',
    ];    
    protected $hidden = [
        'alert_type_id',
        'container_state_id',
    ];
   /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = [
        'alertType',
    ];

    public function alertType()
    {
    	return $this->belongsTo(AlertType::class);
    }    
    public function ContainerState()
    {
        return $this->belongsTo(ContainerState::class);
    }
}
