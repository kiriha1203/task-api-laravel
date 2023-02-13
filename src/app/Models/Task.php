<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

use App\Models\User;

/**
 * @OA\Schema(
 *     schema="Task",
 *     type="object",
 *     description="Task model",
 *     @OA\Property(
 *       property="name",
 *       type="string",
 *       example="",
 *       description=""
 *     )
 * )
 */

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'context',
        'status',
        'create_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function taskUsers()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }
}
