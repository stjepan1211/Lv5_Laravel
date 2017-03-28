@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="row panel-body">
                    <b>Details:</b>                            
                </div>
                
                @foreach($taskData as $task)
                    <form method="post" action="/applies/confirmstudent">
                        <input type="hidden" name="task_id" value="{{$task->id}}">
                        <div class="panel-body">
                            <div class="row">
                                <label>Name:</label>
                                {{$task->name}}
                            </div>
                            <div class="row">
                                <label>Description:</label>
                                {{$task->description}}
                            </div>
                            <div class="row">
                                <label>Study type:</label>
                                {{$task->study_type}}
                            </div>
                            <div class="row">
                                
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <label>Applied students::</label>
                                    <select name="student">
                                        <optgroup>Select student:</optgroup>
                                        @foreach($students as $student)
                                            <option>{{$student}}</option>
                                        @endforeach
                                    </select>

                            </div>                               
                        </div>
                        <button type="submit" class="btn btn-info">Confirm this student</button>
                     </form>
                 @endforeach                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
