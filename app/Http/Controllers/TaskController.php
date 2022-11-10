<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

class TaskController extends Controller
{
    public function ViewTasks()
    {
        $tasks = Task::join("users", "users.id", "=", "tasks.assigned_to")->select('tasks.id', 'description', 'due_date', 'remarks', 'name', 'status')->get();
        $data =  compact('tasks');
        //echo "<pre>";
        //print_r($data->toArray());
        return view('dash')->with($data);
    }

    public function DeleteTask($id)
    {
        $task = Task::find($id);
        try {
            if(!is_null($task)){
                $task->delete();
                Session::flash('message', 'Task deleted!');
                Session::flash('alert-type', 'success');
            }
        }
        catch (QueryException $exception) {
            Session::flash('message', 'Task could not be deleted!');
            Session::flash('alert-type', 'danger');
        }
        return redirect('dash');
    }

    public function EditTask(Request $data)
    {
        $id = $data->get('task_id');
        $task = Task::find($id);

        $task->status = $data['status'];
        $task->remarks = $data['remarks'];
        try {
            if($task->save()) {
                Session::flash('message', 'Task updated!');
                Session::flash('alert-type', 'success');
            }
        }
        catch (QueryException $exception){ //Use catch(\Exception $exception) to find out the type of exception
            Session::flash('message', 'Task could not be updated!');
            Session::flash('alert-type', 'danger');
        }
        return redirect('dash');
    }
}
