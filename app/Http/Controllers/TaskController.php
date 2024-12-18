<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use function Pest\Laravel\delete;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $tasks = Task::all(); //
        $tasks = Task::orderBy('updated_at', 'desc')->paginate(5); //

        return view('tasks.index', compact('tasks'));
//        dd($tasks);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'long_description'=> 'required',
            'completed' => 'nullable'
        ]);
        $task = $request->all();
        if ($request->has('completed')) {
            $task['completed'] = true;
        } else {
            $task['completed'] = false;
        }
        Task::create($task);

        return redirect()->route('tasks.index')->with('success', 'Nhiệm vụ đã được tạo thành công.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
        return view('tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        //
        return view('tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'long_description'=> 'required',
            'completed' => 'nullable'
        ]);
        $taskData = $request->all();
        if ($request->has('completed')) {
            $taskData['completed'] = true;
        } else {
            $taskData['completed'] = false;
        }
        $task->update($taskData);

        return redirect()->route('tasks.index')->with('success', 'Nhiệm vụ đã được cập nhật thành công.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Nhiệm vụ đã được xóa thành công.');
    }
}
