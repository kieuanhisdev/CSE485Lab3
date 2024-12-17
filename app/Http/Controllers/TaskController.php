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
        $tasks = Task::paginate(5); //

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

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');

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
    public function update(Request $request, $task)
    {
        //
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
