<?php

namespace App\Http\Controllers;
use Session;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App\Http\Requests;

class UserController extends Controller
{
    //
    public function editUser()
        {
        //get clicked user
        $userId = Input::get('user_id');
        $role = Input::get('edit_role');
        //DB::update('update users set role = ? where id = ?',['nema','2']);

        DB::table('users')
        ->where('id', $userId)
        ->update(
            [
                'role' => $role
            ]
        );

        //Session::flash('message', 'Successfully updated user!');
        return Redirect::to('/home');
    }

    public function apply()
    {
        $user = Input::get('user');
        $taskId = Input::get('taskId');
        $studentsInTask = DB::table('tasks')->get()->where('id',$taskId)->pluck('students');
        
        $studentsInTaskString = (string)$studentsInTask[0];
        if($studentsInTaskString == "")
            $studentsInTaskString = $user;
        else
            $studentsInTaskString = $studentsInTaskString . ", " . $user;

        DB::table('tasks')
        ->where('id', $taskId)
        ->update(
            [
                'students' => $studentsInTaskString
            ]
        );
        return Redirect::to('/home');
    }

    public function confirmstudent()
    {

       $student = Input::get('student');
       $taskId = Input::get('task_id');

       $studentsInTask = DB::table('tasks')->get()->where('id',$taskId);

       DB::table('tasks')
        ->where('id', $taskId)
        ->update(
            [
                'selected_student' => $student
            ]
        );

       return Redirect::to('/home'); 
    }
}
