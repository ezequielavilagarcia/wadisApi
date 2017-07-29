<?php

namespace App;

use App\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Zone extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'name'
    ];


    public function containers()
    {
    	return $this->hasMany(Container::class);
    }
}
