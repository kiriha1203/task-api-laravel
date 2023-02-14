<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

use App\Models\User;

/**
 * @OA\Schema(
 *      schema="Task",
 *      type="object",
 *      description="Task model",
 *      @OA\Property(
 *          property="id",
 *          description="ID",
 *          type="integer",
 *          format="int64",
 *          example="1"
 *      ),
 *      @OA\Property(
 *          property="title",
 *          description="Task title",
 *          type="string",
 *          format="string",
 *          example="タイトル"
 *      ),
 *      @OA\Property(
 *          property="context",
 *          description="Task context",
 *          type="string",
 *          format="string",
 *          example="内容"
 *      ),
 *      @OA\Property(
 *          property="status",
 *          description="Task status",
 *          type="string",
 *          enum={'waiting', 'working', 'completed'},
 *          example="waiting"
 *       ),
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
        return $this->belongsTo(User::class, 'create_user_id', 'id');
    }
    public function taskUsers()
    {
        return $this->belongsToMany(User::class, 'task_user', 'task_id', 'user_id');
    }
}
