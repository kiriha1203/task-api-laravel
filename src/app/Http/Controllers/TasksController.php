<?php

namespace App\Http\Controllers;

use App\Models\Task;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;
use Throwable;

// TODO: validationの実装

class TasksController extends Controller
{
    /**
     * @OA\Get(
     * path="/api/tasks",
     * tags={"task"},
     * summary="getIndex",
     *      @OA\Response(
     *      response="200",
     *      description="success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  @OA\Property(
     *                      property="tasks",
     *                      type="array",
     *                      @OA\Items(
     *                          ref="#/components/schemas/Task"
     *                      ),
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="metadata",
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="Tasks get index successfully"
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="An error occurred while trying to get the tasks index"
     *              ),
     *          ),
     *      ),
     * )
     *
     * @param \Illuminate\Http\Request $request
     */
    public function index()
    {
        try {
            $tasks = Task::with('user:id,name')
                            ->with('taskUsers:id,name')
                                ->get();
            return new ApiSuccessResponse(
                ['tasks' => $tasks],
                ['message' => 'Tasks get index successfully'],
                Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                'An error occurred while trying to get the tasks index',
                $exception
            );
        }
    }

    /**
     * @OA\Post(
     * path="/api/task",
     * tags={"task"},
     * summary="create",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"title", "context", "status", "create_user_id"},
     *              @OA\Property(
     *                  property="title",
     *                  type="string",
     *                  example="タイトル",
     *                  description="title",
     *              ),
     *              @OA\Property(
     *                  property="context",
     *                  type="string",
     *                  example="内容",
     *                  description="context",
     *              ),
     *               @OA\Property(
     *                   property="status",
     *                   description="Task status",
     *                   type="string",
     *                   enum={"waiting","working","completed"},
     *                   example="waiting"
     *               ),
     *              @OA\Property(
     *                  property="create_user_id",
     *                  type="integer",
     *                  example="1",
     *                  description="create user id",
     *              ),
     *              @OA\Property(
     *                  property="assign_user_ids",
     *                  type="array",
     *                  description="assign users",
     *                  @OA\Items(
     *                      type="integer",
     *                      example="1",
     *                      description="assign user id"
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="201",
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  @OA\Property(
     *                      property="task",
     *                      ref="#/components/schemas/Task"
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="metadata",
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="Task was created successfully"
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="An error occurred while trying to create the task"
     *              ),
     *          ),
     *      ),
     * )
     *
     * @param \Illuminate\Http\Request $request
     */
    public function create(Request $request)
    {
        try {
            $task = Task::create([
                'title' => $request->title,
                'context' => $request->context,
                'status' => $request->status,
                'create_user_id' => $request->create_user_id,
            ]);
            if (!empty($request->assign_user_ids)) {
                $task->taskUsers()->attach($request->assign_user_ids);
            }

            $responseTask = Task::with('user:id,name')
                                    ->with('taskUsers:id,name')
                                        ->find($task->id);

            return new ApiSuccessResponse(
                ['task' => $responseTask],
                ['message' => 'Task was created successfully'],
                Response::HTTP_CREATED
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                'An error occurred while trying to create the task',
                $exception
            );
        }
    }

    /**
     * @OA\Put(
     * path="/api/task",
     * tags={"task"},
     * summary="update",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"task_id", "title", "context", "status"},
     *              @OA\Property(
     *                  property="task_id",
     *                  type="integer",
     *                  example="2",
     *                  description="task id",
     *              ),
     *              @OA\Property(
     *                  property="title",
     *                  type="string",
     *                  example="変更タイトル",
     *                  description="name",
     *              ),
     *              @OA\Property(
     *                  property="context",
     *                  type="string",
     *                  example="内容変更",
     *                  description="context",
     *              ),
     *               @OA\Property(
     *                   property="status",
     *                   description="Task status",
     *                   type="string",
     *                   enum={"waiting","working","completed"},
     *                   example="completed"
     *               ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  @OA\Property(
     *                      property="task",
     *                      ref="#/components/schemas/Task"
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="metadata",
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="Task update successfully"
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="An error occurred while trying to update the task"
     *              ),
     *          ),
     *      ),
     * )
     *
     * @param \Illuminate\Http\Request $request
     */
    public function update(Request $request)
    {
        try {
            $task = Task::with('user:id,name')
                            ->with('taskUsers:id,name')
                                ->find($request->task_id);
            $task->update([
                'title' => $request->title,
                'context' => $request->context,
                'status' => $request->status,
            ]);


            return new ApiSuccessResponse(
                ['task' => $task],
                ['message' => 'Task update successfully'],
                Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                'An error occurred while trying to update the task',
                $exception
            );
        }
    }

    /**
     * @OA\Put(
     * path="/api/task/assign",
     * tags={"task"},
     * summary="update",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              type="object",
     *              required={"task_id"},
     *              @OA\Property(
     *                  property="task_id",
     *                  type="integer",
     *                  example="2",
     *                  description="task id",
     *              ),
     *              @OA\Property(
     *                  property="assign_user_ids",
     *                  type="array",
     *                  description="assign users",
     *                  @OA\Items(
     *                      type="integer",
     *                      example="1",
     *                      description="assign user id"
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response="200",
     *          description="success",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  @OA\Property(
     *                      property="task",
     *                      ref="#/components/schemas/Task"
     *                  ),
     *              ),
     *              @OA\Property(
     *                  property="metadata",
     *                  @OA\Property(
     *                      property="message",
     *                      type="string",
     *                      example="Task update successfully"
     *                  ),
     *              ),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Internal Server Error",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="message",
     *                  type="string",
     *                  example="An error occurred while trying to update the task"
     *              ),
     *          ),
     *      ),
     * )
     *
     * @param \Illuminate\Http\Request $request
     */
    public function assignTask(Request $request)
    {
        try {
            $task = Task::find($request->task_id);
            $task->taskUsers()->sync($request->assign_user_ids);

            $responseTask = Task::with('user:id,name')
                                    ->with('taskUsers:id,name')
                                        ->find($request->task_id);

            return new ApiSuccessResponse(
                ['task' => $responseTask],
                ['message' => 'User update successfully'],
                Response::HTTP_OK
            );
        } catch (Throwable $exception) {
            return new ApiErrorResponse(
                'An error occurred while trying to update the user',
                $exception
            );
        }
    }
}
