<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Tasks;
use App\Models\Contacts;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'create_user_id');
    }
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
    public function contact_tasks()
    {
        return $this->belongsToMany(Task::class, 'contacts', 'user_id', 'task_id');
    }
}
