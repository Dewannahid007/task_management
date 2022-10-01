<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    //
    public function index(Request $request){

       $tasks= DB::table('tasks')->get();
        
        return view('index',['tasks'=>$tasks]);

    }

    public function createTasksForm(){
        return view('createTasksForm');
    }
    public function createNewTask(Request $request){
       $title= $request->input('title');
       $description= $request->input('description');
       $status= $request->input('status');
       $progress= $request->input('progress');

       DB::table('tasks')->insert([
        'title'=>$title,
        'description'=>$description,
        'status'=>$status,
        'progress'=>$progress

       ]);
       return redirect('/');

    }
    public function editTasksForm(Request $request,$id){
        $task=DB::table('tasks')->where('id',$id)->get();
        return view('editTasksForm',['task'=>$task]);

    }
    public function editTask(Request $request){
        $id= $request->input('id');
        $title= $request->input('title');
        $description=$request->input('description');
        $status= $request->input('status');
        $progress= $request->input('progress');

        $editTask=DB::table('tasks')->where('id',$id)->update([
            'title'=>$title,
            'description'=>$description,
            'status'=>$status,
            'progress'=>$progress

        ]);
        return redirect('/');

    }
}
