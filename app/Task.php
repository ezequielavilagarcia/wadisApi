<?php

namespace App;

use App\TaskType;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
    'task_type_id',
    'user_profile_id'
    ];



    protected $with = [
    'taskType',
    'userProfile'
    ];
    public function taskType(){
    	return $this->belongsTo(TaskType::class);
    }    
    public function userProfile(){
    	return $this->belongsTo(UserProfile::class);
    }
}
