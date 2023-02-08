<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Contact extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
