<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("todos", [
            "todos" => Todo::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = collect($request->only(["title"]))->merge([
            "is_done" => false
        ]);

        Todo::create($data->toArray());

        return response()->redirectTo("/todos");

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Todo $todo)
    {

        if ($todo->is_done) {
            $todo->is_done = false;
        } else {
            $todo->is_done = true;
        }

        $todo->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo)
    {
        //
    }
}
