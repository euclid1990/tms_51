@extends('layouts.app')
@section('title') {{ trans('settings.title') }} @stop
@section('content')

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="tagline">
                @if (Auth::user()->can('updateUser', $user)) 
                    {{ trans('settings.my_profile') }}
                @else 
                    {{ trans('settings.profile') }}
                @endif
                </h2>
            </div>
            @if (Auth::user()->can('updateUser', $user)) 
            <div class="col-md-offset-4 col-md-2">
                <a href="{{ url('user/' . $user->id . '/edit') }}" class="btn btn-primary">
                    <i class="fa fa-pencil"></i> 
                    {{ trans('settings.edit') }}
                </a>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-3">
                    <img src="{{ $user->avatar }}" class="img-thumb img-circle">
                </div>
                <div class="col-md-9">
                    <table class="table">
                        <tr>
                            <td>{{ trans('settings.name') }}: </td>
                            <td colspan="2">{{ $user->name }} </td>
                        </tr>
                        <tr>
                            <td>{{ trans('settings.email') }}: </td>
                            <td colspan="2">{{ $user->email }} </td>
                        </tr>
                        <tr>
                            <td>{{ trans('settings.active_course') }}: </td>
                            @if ($course)
                            <td>
                                <span class="alert-custom alert-danger">
                                    <strong>{{  $course->name }} </strong> 
                                </span>
                                <span>
                                    ({{  $course->pivot->start_date }} - {{  $course->pivot->end_date }})
                                </span>
                            </td>
                            <td>  
                                {!! $course->pivotStatus !!}
                            </td>
                            @else 
                                <td>
                                    {{ trans('settings.empty_course') }}
                                </td>
                            @endif
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <h2 class="tagline">{{ trans('settings.all_subject') }} </h2>
            <div class="col-md-12">
                <p class="lead">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                    @if ($subjects)
                        @foreach ($subjects as $subject)
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="heading{{ $subject->id }}">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $subject->id }}" aria-expanded="false" aria-controls="collapse{{ $subject->id }}">
                                            {{ $subject->name }} 
                                            <div class="head-status">
                                                {!! $user->subjects->find($subject->id)->pivotStatus !!}
                                            </div>
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapse{{ $subject->id }}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{ $subject->id }}">
                                    <ul class="list-group"> 
                                        @foreach ($subject->tasks as $task)
                                            <li class="list-group-item">
                                                {{ $task->name }}
                                                <div class="head-status">
                                                    @if ($subject->isTraining())
                                                        {!! $user->tasks->find($task->id)->pivotStatus !!}
                                                    @endif
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    @else     
                        {{ trans('settings.empty_subject') }}
                    @endif
                    </div>
                </p>   
            </div>
        </div>
        <div class="row">
            <h2 class="tagline">{{ trans('settings.activities') }} </h2>
            <div class="col-md-12">
                <p class="lead">
                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel panel-default">
                            <div id="collapse1" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="heading1">
                                <ul class="list-group"> 
                                @if ($activity)
                                    @foreach ($activity as $item)
                                        <li class="list-group-item">
                                            {{ $item->description }} - ({{ $item->created_at->diffForHumans() }})
                                        </li>
                                    @endforeach
                                @else 
                                    <li class="list-group-item">
                                        {{ trans('settings.empty_activity') }}
                                    </li>
                                @endif 
                                </ul>
                            </div>
                        </div>
                    </div>
                </p>   
            </div>
        </div>
    </div>
</div>
@endsection
