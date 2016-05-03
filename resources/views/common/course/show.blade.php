@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                    <h2>{{ trans('settings.show_course') }}</h2>
                </div>
                <div class="col-md-6 col-md-offset-2">
                @if (!$course->isFinish())
                    <a title="{{ trans('settings.add_trainee') }}" class="btn btn-success" href="">
                        <i class="fa fa-plus"></i> {{ trans('settings.add_trainee') }}
                    </a>  
                    <a title="{{ trans('settings.add_supervisor') }}" class="btn btn-primary" href="">
                        <i class="fa fa-plus"></i> {{ trans('settings.add_supervisor') }}
                    </a>
                    @if ($course->isStart())
                        <a title="{{ trans('settings.start_course') }}" class="btn btn-info" href="">
                            <i class="fa fa-refresh"></i>  
                            {{ trans('settings.start_course') }}
                        </a> 
                    @else 
                        <a title="{{ trans('settings.finish_course') }}" class="btn btn-warning" href="">
                            <i class="fa fa-hourglass-end "></i>  
                            {{ trans('settings.finish_course') }}
                        </a>
                    @endif
                @endif
                </div>
            </div>   
        </div>     
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-3">
                    {{ Form::label('name', trans('settings.name')) }}
                </div>
                <div class="col-sm-9">
                    {{ Form::label('name', old('name', isset($course) ? $course->name : null)) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-3">
                {{ Form::label('description', trans('settings.description')) }}
                </div>
                <div class="col-sm-9">
                {{ Form::label('description', old('description', isset($course) ? $course->description : null)) }}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-3">
                    {{ Form::label('status', trans('settings.status')) }}
                </div>
                <div class="col-sm-9">
                    @if ($course->isStart())
                        <span class="label label-default">{{ trans('settings.start') }}</span>
                    @elseif ($course->isTraining())
                        <span class="label label-primary">{{ trans('settings.training') }}</span>
                    @else
                        <span class="label label-danger">{{ trans('settings.finish') }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-3">
                    {{ Form::label('status', trans('settings.supervisor')) }}
                </div>
                <div class="col-sm-9">
                @foreach ($course->users as $user)
                    @if ($user->isSupervisor()) 
                        <a href="{{ route('user.show', $user->id) }}" title="{{ trans('settings.profile') }}">
                            {{ $user->name }}
                        </a>,  
                    @endif
                @endforeach
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="col-sm-3">
                    {{ Form::label('status', trans('settings.trainee')) }}
                </div>
                <div class="col-sm-9">
                @foreach ($course->users as $user)
                    @if ($user->isTrainee()) 
                        <a href="{{ route('user.show', $user->id) }}" title="{{ trans('settings.profile') }}">
                            {{ $user->name }}
                        </a>,  
                    @endif
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
