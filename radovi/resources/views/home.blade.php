@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="row panel-body">
                    <b>@lang('messages.welcome')</b>
                                          
                </div>
                <div class="panel-body">

                    @foreach($data as $user)
                        @if($user->role == 'admin' && Auth::user()->email == $user->email)
                        
                            <h4>{{$user->name}} you are admin. You can change this users.</h4>
                            @foreach($data as $user)
                                @if($user->role == 'unknown')
                                    <div class="row panel-body">
                                        <h4>{{$user->name}}.</h4>
                                        <p>Current role: {{$user->role}}</p>
                                    </div>
                                    <div class="row panel-body">
                                        <form method="post" action="editUser">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="user_id" value="{{$user->id}}">
                                        <select required class="selectpicker" name="edit_role">
                                            <option>student</option>
                                            <option>profesor</option>
                                        </select>
                                        <button type="submit" class="btn btn-info">Edit</button>
                                    </form>
                                    </div>
                                    
                                    <hr style="height: 3px; background-color: #000">
                                @endif
                            @endforeach
                        @endif
                    @endforeach 

                    @foreach($data as $user)
                        @if($user->role == 'profesor' && Auth::user()->email == $user->email)
                            
                            <div class="row panel-body">
                                <h4>{{$user->name}} you are profesor. You can add task.</h4>
                                <form method="post" action="croatian">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <input type="hidden" name="locale" value="hr">
                                    <button type="submit">Hr</button>
                                </form>
                                <form method="post" action="english">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <input type="hidden" name="locale" value="en">
                                    <button type="submit">En</button>
                                </form>
                                
                                
                            </div>
                            
                                                  
                                <div class="panel-body">
                                    <form method="post" action="addTask">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="profesor" value="{{Auth::user()->name}}">
                                    <div class="row form-group">
                                        <label>@lang('messages.name'):</label>
                                        <input required="" type="text" name="name">
                                    </div>

                                    <div class="row form-group">
                                        <label>@lang('messages.english_name'):</label>
                                        <input required="" type="text" name="name_in_english">
                                    </div>
                                    <div class="row form-group">
                                        <label>@lang('messages.description'):</label>
                                        <input required="" type="text" name="description">
                                    </div>
                                    <div class="row form-group">
                                        <label>@lang('messages.study_type'):</label>
                                            <select required class="selectpicker" name="study_type">
                                                <option>undergraduate</option>
                                                <option>graduate</option>
                                                <option>professional study programme</option>
                                            </select>
                                    </div>
                                    <button type="submit" class="btn btn-info">Add</button>
                                </form>
                               
                                </div>

                                <br>
                                <br>
                                <h5>My tasks:</h5>
                            @foreach($tasksdata as $task)
                                @if($task->profesor==Auth::user()->name)
                                    <div class="panel-body">
                                        <div class="row">
                                            <label>@lang('messages.name'):</label>
                                            <p>{{$task->name}}</p>
                                        </div>
                                        <div class="row">
                                            <label>@lang('messages.description'):</label>
                                            <p>{{$task->description}}</p>
                                        </div>
                                        <div class="row">
                                            <label>@lang('messages.study_type'):</label>
                                            <p>{{$task->study_type}}</p>
                                        </div>
                                        @if($task->selected_student == null)
                                            <a href="{{url('applies/' . $task->id)}}">Select student</a>
                                        @endif
                                        @if($task->selected_student != null)
                                            <div class="row">
                                            <label>Selected student:</label>
                                            <p>{{$task->selected_student}}</p>
                                        </div>
                                        @endif
                                    </div>
                                @endif
                            @endforeach                             
                        @endif
                    @endforeach 


                     @foreach($data as $user)
                        @if($user->role == 'student' && Auth::user()->email == $user->email)
                            
                            <div class="panel-body">
                                <h4>{{$user->name}} you are student. You can choose task.</h4>

                                @foreach($tasksdata as $task)
                                    @if($task->selected_student == null)
                                    
                                        <table class="table table-responsive">
                                            <tr>
                                                <th>Name</th>
                                                <th>English name</th>
                                                <th>Description</th>
                                                <th>Study type</th>                                     
                                            </tr>
                                            <tr>
                                                <td>{{$task->name}}</td>
                                                <td>{{$task->name_in_english}}</td>
                                                <td>{{$task->description}}</td>
                                                <td>{{$task->study_type}}</td>
                                                <td>
                                                    <form method="post" action="apply">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="user" value="{{Auth::user()->name}}">
                                                        <input type="hidden" name="taskId" value="{{$task->id}}">

                                                        <button type="submit" class="btn btn-info" >Apply</button>
                                                    </form>
                                                    
                                                </td>
                                            </tr>
                                        </table>

                                    @endif
                                @endforeach
                            </div>                   
                        @endif
                    @endforeach 

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
