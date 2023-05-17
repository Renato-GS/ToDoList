<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(Task $task)
    {
        $tasks = $task->select()->orderBy('created_at','asc')->get();

        return view('index', compact('tasks'));
    }

    public function show(string|int $id)
    {
        //$task = Task::where('status',$id)->first() ;
        $task = Task::find($id);
        if (!$task = Task::find($id)) {
            return back();
        }

        return view('show', compact('task'));
    }

    public function create()
    {
        return view('create');
    }


    public function store(Request $request, Task $task)
    {
        $data = $request->all();
        $data['status'] = 'o';

        $task->create($data);

        return redirect()->route('todo.index');
    }

    public function edit(Task $task, string|int $id)
    {
        if (!$task = $task->where('id', $id)->first()) {
            return back();
        }
        return view('edit', compact('task'));
    }

    public function update(Request $request, Task $task, string $id)
    {
        if (!$task = $task->where('id', $id)->first()) {
            return back();
        }
        $task->update($request->only('task'));
        return redirect()->route('todo.index');
    }

    public function delete(string|int $id)
    {
        $task= Task::find($id);

        $task->delete();

        return true;
    }

    public function mark(Request $request,string|int $id)
    {
        $task = Task::find($id);

        if ($task->status == 'o'){
            $task->status = 'c';
            $task->save();
        }else
            $task->status = 'o';
            $task->save();

        return true;
    }

    public function filter(Task $task, Request $request, string $filter)
    {

        if ($filter == "todos"){
            $tasks = $task->select()->orderBy('created_at','asc')->get();
        } else if($filter == "ativos") {
            $tasks = $task->where('status','o')->orderBy('created_at','asc')->get();
    } else {
            $tasks = $task->where('status','c')->orderBy('created_at','asc')->get();
      }

        return $tasks;

    }

}

