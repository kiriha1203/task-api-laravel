<?php

namespace App\Http\Controllers;

use App\Models\Task;

use App\Http\Responses\ApiErrorResponse;
use App\Http\Responses\ApiSuccessResponse;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use OpenApi\Annotations as OA;
use Throwable;

class TasksController extends Controller
{
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

    public function assignTask(Request $request)
    {
        try {
            $task = Task::find($request->task_id);
            $task->taskUsers()->sync($request->user_ids);

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
