<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;
use App\Task_Status_History;
use Carbon\Carbon;
class EmergencyTasksController extends Controller
{
    public function view($id)
    {
    	$data['task']=Tasks::where('id',$id)->first();
    	 // dd($data);
    	return view('tasks.emergency_view',$data);
    }

    public function change_task_state(Request $request  ,$id)
    {
    	$state = $request['task_satuts'];
        $task=Tasks::find($id);
        $task->update(['task_status_id'=>$state]);
        // dd($case);
        Task_Status_History::create([
        	'task_id'=>$task->id,
        	'task_status_id'=>$state,
        	'datetime'=>Carbon::now()->format('Y-m-d H:i:s'),
        	'user_id'=>\Auth::user()->id
        ]);

        return redirect()->route('task_emergency_view',$id);
    }
    public function task_destroy($id)
    {
   $task=Tasks::find($id)->delete();
   
   return redirect()->route('tasks_emergency');
    }

    public function task_destroy_all()
    {
    	$ids = $_POST['ids'];
        foreach($ids as $id)
        {
        $task=Tasks::find($id)->delete();
        } 
        return redirect()->route('tasks_emergency');
    }

    public function add_emergency_task(Request $request)
    {
    	
    }
}
