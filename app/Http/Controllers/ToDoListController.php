<?php

namespace App\Http\Controllers;

use App\ToDoList;
use Illuminate\Http\Request;
use App\Http\Requests\TodoListSaveRequest;

class ToDoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if(\Auth::guard('web')->check()){
            $user = \Auth::user();
            $todolists = $user->todolists->where('is_completed','0');
            $complete_todolists = $user->todolists->where('is_completed','1');
            //dd($complete_todolists);
            
            return view('todo_list.index',compact('todolists','complete_todolists'));
        }
        return redirect('login');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoListSaveRequest $request)
    {
        if(\Auth::guard('web')->check()){
            $param = new ToDoList();
            $param->user_id = \Auth::id();
            $param->description = $request->get('description');
            $param->save();

            return redirect(route('todolists.index'));
        }
        return redirect()->back();

    }

    public function complete(Request $request){
        $id = $request->get('id');
        $param = ToDoList::find($id);
        $param->is_completed = 1;
        $param->update();

        return \Response::json('success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function show(ToDoList $toDoList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function edit(ToDoList $toDoList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ToDoList $toDoList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ToDoList  $toDoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(ToDoList $toDoList)
    {
        //
    }
}
