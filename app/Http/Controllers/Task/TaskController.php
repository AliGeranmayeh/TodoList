<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\DB\TaskRepository;
use App\Helpers\Responses\TaskResponse;
use App\Http\Requests\Tasks\CreateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $tasks = TaskRepository::getUserTasks(auth()->user()->id);
        }
        catch (\Throwable $th) {
            return TaskResponse::failed();
        }

        return TaskResponse::indexSuccess($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request)
    {
        $inputData = $this->prepareStoreData($request);

        try {
            $task = TaskRepository::createTask($inputData);
        }
        catch (\Throwable $th) {
            return TaskResponse::failed();
        }

        return TaskResponse::createSuccess($task);



    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return TaskResponse::showSuccess($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    //
    }


    private function prepareStoreData($dataObj)
    {
        $data = $dataObj->validated();
        $data['user_id'] = auth()->user()->id; //add user_id to data

        return $data;
    }
}
