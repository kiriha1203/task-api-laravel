<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

use App\Models\Tasks;
use App\Models\Contacts;

/**
 * @OA\Schema(
 *      schema="User",
 *      type="object",
 *      description="User model",
 *      @OA\Property(
 *          property="id",
 *          description="ID",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="name",
 *          description="name",
 *          type="string",
 *          format="string",
 *          example="山田太郎"
 *      ),
 *      @OA\Property(
 *          property="email",
 *          description="email",
 *          type="string",
 *          format="string",
 *          example="test@example.com"
 *      ),
 *      @OA\Property(
 *          property="create_at",
 *          description="create_at",
 *          type="timestamp",
 *          format="timestamp",
 *          example="2023-02-01T12:11:11.000000Z"
 *      ),
 *      @OA\Property(
 *          property="update_at",
 *          description="update_at",
 *          type="timestamp",
 *          format="timestamp",
 *          example="2023-02-01T12:11:11.000000Z"
 *      ),
 * )
 */
class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
    ];


    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function userTasks()
    {
        return $this->belongsToMany(Task::class, 'task_user', 'task_id', 'user_id');
    }
}
