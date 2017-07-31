<?php

namespace App;

use App\Container;
use App\User;
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
    public function user()
    {
        return $this->hasMany(User::class);
    }    
    /* ARREGLAR CONSTANTES */
    public function userRecolector()
    {
        return $this->hasOne(User::class)->where('user_profile_id',1)->latest();
    }    
    public function userMantenimiento()
    {
        return $this->hasOne(User::class)->where('user_profile_id',3)->latest();
    }    
    public function userUrgencia()
    {
    	return $this->hasOne(User::class)->where('user_profile_id',4)->latest();
    }
}
