<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use App\Models\Todo ;

class Todocontroller extends Controller
{
    public function index()
    {
        $userId = auth()->id();

    // Retrieve only the tasks for the authenticated user
    $todos = Todo::where('id_user', $userId)->get();

    return view('todos.index', [
        'todos' => $todos,
    ]);
    }

    public function create()
    {
        return view('todos.create') ;
    }

    public function store(Request $req)
    {
        $userId = auth()->id();
    
        Todo::create([
            'title' => $req->title,
            'description' => $req->description,
            'is_completed' => 0,
            'id_user' => $userId,
        ]);
    
        return redirect()->route('todos.index');
    }


    public function show($id)
    {
       $todo= Todo::find($id) ;
        if(! $todo)
        {
            return to_route('todos.index')->withErrors([
                'error'=>'Unable to locate the Todo'
            ]) ;

        }
        return view('todos.show',['todo'=>$todo]) ;
    }

    public function edit($id)
    {
        $todo= Todo::find($id) ;
        if(! $todo)
        {
            return to_route('todos.index')->withErrors([
                'error'=>'Unable to locate the Todo'
            ]) ;

        }
        return view('todos.edit',['todo'=>$todo]) ;
    }

    public function update(Request $req)
{
    $todo = Todo::find($req->todo_id);

    $isCompleted = ($req->is_completed == 'Select option') ? null : $req->is_completed;

    $todo->update([
        'title' => $req->title,
        'description' => $req->description,
        'is_completed' => $isCompleted,
    ]);

    return redirect()->route('todos.index');
}

public function destroy(Request $req)
{
    $todo = Todo::find($req->todo_id) ;
    $todo->delete() ;
    return to_route('todos.index') ;
}

    
}
