<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function list($ids = null): String
    {
        if ($ids) {
            $tasks = Task::whereIn('id', $ids)->get();
        } else {
            $tasks = Task::orderBy('created_at','desc')->get();
        }

        return json_encode($tasks);
    }

    public function store(Request $request)
    {
        $validatedForm = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ]);

        Task::create([
            'title' => $validatedForm['title'],
            'description' => $validatedForm['description'],
            'owner' => Auth::id(),
        ]);
    }

    public function update(Request $request)
    {
        $validatedForm = $request->validate([
            'id' => 'required|integer',
        ]);

        $task = Task::where('id', $validatedForm['id'])
            ->where('owner', Auth::id())
            ->first();

        if ($task) {
            $task->complete = true;
            $task->save();
        }  else {
            return json_encode([
                'status' => 'error',
                'message' => 'not authorised',
            ]);
        }
    }

    public function delete(Request $request)
    {
        $validatedForm = $request->validate([
            'id' => 'required|integer',
        ]);

        $task = Task::where('id', $validatedForm['id'])
            ->where('owner', Auth::id())
            ->first();

        if ($task) {
            $task->delete();
        } else {
            return json_encode([
                'status' => 'error',
                'message' => 'not authorised',
            ]);
        }
}
}
