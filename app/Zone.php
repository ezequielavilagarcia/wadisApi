<?php

namespace App;

use App\Container;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    protected $fillable = [
    	'name'
    ];


    public function containers()
    {
    	return $this->hasMany(Container::class);
    }
}
