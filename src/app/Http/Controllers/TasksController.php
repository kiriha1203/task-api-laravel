<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TasksController extends Controller
{
    public function index()
    {
        $tasks = Task::with('user:id,name')
                        ->with('taskUsers:id,name')
                            ->get();
        return response()->json($tasks);
    }

    public function create(Request $request) {
        $task = Task::create([
            'title' => $request->title,
            'context' => $request->context,
            'status' => $request->status,
            'create_user_id' => $request->create_user_id,
        ]);
        if ( !empty($request->assign_user_ids) ) {
            $task->taskUsers()->attach($request->assign_user_ids);
        }

        $responseTask = Task::with('user:id,name')
                                ->with('taskUsers:id,name')
                                    ->find($task->id);

        return response()->json($responseTask);
    }

    public function update(Request $request) {
        $task = Task::with('user:id,name')
                        ->with('taskUsers:id,name')
                            ->find($request->task_id);
        $task->update([
            'title' => $request->title,
            'context' => $request->context,
            'status' => $request->status,
        ]);
    }



    public function assignTask(Request $request) {
        $task = Task::find($request->task_id);
        $task->taskUsers()->sync($request->user_ids);

        $responseTask = Task::with('user:id,name')
                                ->with('taskUsers:id,name')
                                    ->find($request->task_id);

        return response()->json($responseTask);
    }
}
