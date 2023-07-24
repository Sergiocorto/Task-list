<?php


namespace App\Services;


use App\Models\Task;
use App\Http\Resources\TaskResource;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TaskService
{
    public function getAllTasks()
    {
        try {
            return DB::transaction(function () {
                $tasks = Task::all();
                return TaskResource::collection($tasks);
            });
        } catch (QueryException $e) {
            return response()->json(['error' => 'Произошла ошибка при выполнении транзакции'], 500);
        }
    }

    public function createTask(array $data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        try {
            return DB::transaction(function () use ($data) {
                Task::create($data);
                $task = Task::latest()->first();
                return new TaskResource($task);
            });
        } catch (QueryException $e) {
            return response()->json(['error' => 'Произошла ошибка при выполнении транзакции'], 500);
        }
    }

    public function updateTask($id, array $data)
    {
        $validator = Validator::make($data, [
            'title' => 'required|string|max:255',
            'status_id' => 'required|exists:statuses,id',
        ]);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        try {
            return DB::transaction(function () use ($id, $data) {
                $task = Task::findOrFail($id);
                $task->title = $data['title'];
                $task->status_id = $data['status_id'];
                $task->save();
                return new TaskResource($task);
            });
        } catch (QueryException $e) {
            return response()->json(['error' => 'Произошла ошибка при выполнении транзакции'], 500);
        }
    }

    public function deleteTask($id)
    {
        try {
            return DB::transaction(function () use ($id) {
                $task = Task::findOrFail($id);
                $task->delete();
            });
        } catch (QueryException $e) {
            return response()->json(['error' => 'Произошла ошибка при выполнении транзакции'], 500);
        }
    }
}
