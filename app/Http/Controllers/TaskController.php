<?php

namespace App\Http\Controllers;

use App\Services\TaskService;
use http\Client\Response;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    private $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index($paginate, Request $request)
    {
        return $this->taskService->getAllTasks($paginate, $request);
    }

    public function store(Request $request)
    {
        $title = $request->input('title');
        $data = ['title' => $title];
        return $this->taskService->createTask($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->only('title', 'status_id');
        return $this->taskService->updateTask($id, $data);
    }

    public function destroy($id)
    {
        $this->taskService->deleteTask($id);
        return response()->json($id);
    }
}
