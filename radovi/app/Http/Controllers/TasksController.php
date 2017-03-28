<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Http\Requests;

class TasksController extends Controller
{
    //
    public function addTask()
    {
    	$name = Input::get('name');
        $name_in_english = Input::get('name_in_english');
        $description = Input::get('description');
        $study_type = Input::get('study_type');
        $profesor = Input::get('profesor'); 
        DB::table('tasks')
        ->insert(
            [
                'name' => $name, 
                'name_in_english' => $name_in_english,
                'description' => $description, 
                'study_type' => $study_type, 
                'profesor' => $profesor 
            ]
        );
        //Add to DB
        return redirect('/home');
    }

    public function applies($task_id)
    {
        $taskData = DB::table('tasks')->get()->where('id', $task_id);

        foreach ($taskData as $task) {
            $students = array();
            $appliedStudents = array();
            array_push($appliedStudents,$task->students);
            $appliedStudentsParts = explode(',', $appliedStudents[0]);

            foreach($appliedStudentsParts as $part){
                array_push($students, $part);
            }
        }

        return view('taskdetails', ['taskData' => $taskData, 'students' => $students]);
    }

}
