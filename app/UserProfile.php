<?php

namespace App;

use App\Task;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserProfile extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    
    protected $fillable = [
    	'name'
    ];    

    public function tasks()
    {
    	return $this->hasMany(Task::cLass);
    }
   	public function users()
    {
    	return $this->hasMany(User::cLass);
    }
}
