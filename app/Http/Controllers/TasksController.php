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
       $completedTasks=DB::table('tasks')->where('status','complete')->get()->count();
       $inprogressTasks=DB::table('tasks')->where('status','In progress')->get()->count();

        $totalTasks = $tasks->count();
        return view('index',['tasks'=>$tasks,'totalTasks'=>$totalTasks,'completedTasks'=>$completedTasks,'inprogressTasks'=>$inprogressTasks]);

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
    public function editAllTasks(Request $request){
        $tasks = DB::table('tasks')->get();
        return view('editAllTasks',['tasks'=>$tasks]);
    }

    public function deleteTask(Request $request,$id){
        DB::table('tasks')->where('id',$id)->delete();
        return redirect('/');
    }

    public function InprogressTasks(Request $request){
       $tasks= DB::table('tasks')->where('status','In Progress')->get();
       return view('specificTasks',['tasks'=>$tasks]);

    }
    public function CompletedTasks(Request $request){
        $tasks= DB::table('tasks')->where('status','complete')->get();
        return view('specificTasks',['tasks'=>$tasks]);

    }
}
