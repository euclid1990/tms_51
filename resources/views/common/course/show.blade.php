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
                    <button type="button" data-toggle="modal" data-target="#modalAddTrainee" class="btn btn-success">
                        <i class="fa fa-plus"></i> {{ trans('settings.add_trainee') }}
                    </button>  
                    <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddSupervisor" >
                        <i class="fa fa-plus"></i> {{ trans('settings.add_supervisor') }}
                    </button>
                    @if (count($course->users()->trainee()->get()) > 0)
                        @if ($course->isStart())
                            <a title="{{ trans('settings.start_course') }}" class="btn btn-info" href="{{ route('startCourse', $course->id) }}">
                                <i class="fa fa-refresh"></i>  
                                {{ trans('settings.start_course') }}
                            </a> 
                        @else 
                            <a title="{{ trans('settings.finish_course') }}" class="btn btn-warning" href="{{ route('finishCourse', $course->id) }}">
                                <i class="fa fa-hourglass-end "></i>  
                                {{ trans('settings.finish_course') }}
                            </a>
                        @endif
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
<!-- Add trainee modal -->
<div class="modal fade" id="modalAddTrainee" tabindex="-1" role="dialog" aria-labelledby="modalAddTraineeLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('settings.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalAddTraineeLabel"> {{ trans('settings.add_trainee') }}</h4>
            </div>
            {{ Form::open([
                'route' => 'admin.user-course.store', 
                'name' => 'formAddTrainee', 
                'method' => 'POST'
            ]) }}
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <div class="modal-body">
                <div class="form-group">
                    {{ Form::label('name', trans('settings.trainee')) }}
                    {!! Form::select('user_id', $trainee, null,  [
                        'class' => 'form-control', 
                    ]) !!}
                </div>
                <div class="form-group">
                    {{ Form::label('start_date', trans('settings.start_date')) }}
                    {!! Form::date('start_date', null,  [
                        'class' => 'form-control', 
                        'required' => 'required'
                    ]) !!}
                </div>
                <div class="form-group">
                    {{ Form::label('end_date', trans('settings.end_date')) }}
                    {!! Form::date('end_date', null,  [
                        'class' => 'form-control', 
                        'required' => 'required'
                    ]) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('settings.close') }}</button>
                {{ Form::submit(trans('settings.create'), [
                    'class' => 'btn btn-primary'
                ]) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>

<!-- Add supervisor modal -->
<div class="modal fade" id="modalAddSupervisor" tabindex="-1" role="dialog" aria-labelledby="modalAddSupervisorLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('settings.close') }}"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalAddSupervisorLabel"> {{ trans('settings.add_supervisor') }}</h4>
            </div>
            {{ Form::open([
                'route' => 'admin.user-course.store', 
                'name' => 'formAddSupervisor', 
                'method' => 'POST'
            ]) }}
            <input type="hidden" name="course_id" value="{{ $course->id }}">
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::select('user_id', $supervisor, null,  [
                        'class' => 'form-control', 
                    ]) !!}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('settings.close') }}</button>
                {{ Form::submit(trans('settings.create'), [
                    'class' => 'btn btn-primary'
                ]) }}
            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>


@endsection
