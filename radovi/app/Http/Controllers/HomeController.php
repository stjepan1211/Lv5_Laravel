<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use App;
use Illuminate\Foundation\Application;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get users and check language
        $loggedUser = DB::table('users')->where('email', Auth::user()->email)->first();
        App::setlocale($loggedUser->locale);
        $users = DB::table('users')->get();
        $data = array();
        foreach($users as $user)
        {
            array_push($data, $user);   
        }
        //get tasks
        $tasks = DB::table('tasks')->get();
        $tasksdata = array();
        foreach($tasks as $task)
        {
            array_push($tasksdata, $task);   
        }

        return view('home', ['data' => $data, 'tasksdata' => $tasksdata]);
    }


    public function changeToEnglishLang()
    {

        $userId = Input::get('user_id');
        $locale = Input::get('locale');
        //DB::update('update users set role = ? where id = ?',['nema','2']);

        DB::table('users')
        ->where('id', $userId)
        ->update(
            [
                'locale' => 'en'
            ]
        );
        return Redirect::to('/home');
    }

    public function changeToCroatianLang()
    {

        $userId = Input::get('user_id');
        $locale = Input::get('locale');
        //DB::update('update users set role = ? where id = ?',['nema','2']);

        DB::table('users')
        ->where('id', $userId)
        ->update(
            [
                'locale' => 'hr'
            ]
        );
        return Redirect::to('/home');
    }
}
