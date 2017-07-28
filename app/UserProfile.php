<?php

namespace App;

use App\Task;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table= "user_profiles";
    protected $connection= "mysql";
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
