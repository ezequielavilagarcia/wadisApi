<?php

namespace App;

use App\UserProfile;
use App\Zone;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable,SoftDeletes;

    protected $dates = ['deleted_at'];

    const USER_ROOT = '1';
    const USER_NORMAL = '0';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'name',
        'last_name',
        'email',
        'password',
        'identification',
        'root',
        'user_profile_id',
        'zone_id'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','user_profile_id',
        'zone_id'
    ];

    protected $with = [
        'zone',
        'userProfile'
    ];

    public function zone(){
        return $this->belongsTo(Zone::class);
    }    
    public function userProfile(){
        return $this->belongsTo(UserProfile::class);
    }
    public function containerTasks(){
        return $this->hasMany(ContainerTask::class);
    }
}
