@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>{{ trans('settings.edit_subject') }}</h2>
                {{ Form::open([
                    'route' => ['admin.subject.update', $subject->id], 
                    'name' => 'formEditSubject', 
                    'method' => 'PUT'
                ]) }}
                <div class="form-group">
                    {{ Form::label('name', trans('settings.name')) }}
                    {{ Form::text('name', old('name', isset($subject) ? $subject->name : null), [
                        'class' => 'form-control', 
                        'id' => 'name'
                    ]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('description', trans('settings.description')) }}
                    {{ Form::textarea('description', old('description', isset($subject) ? $subject->description : null), [
                        'class' => 'form-control', 
                        'id' => 'description',
                        'rows' => 6
                    ]) }}
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('settings.task') }} </h3>
                        <div class="head-panel">
                            <a class="btn btn-success" title="{{ trans('settings.add_task') }}" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus"></i> 
                                {{ trans('settings.add_task') }}
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                @foreach ($subject->tasks as $task)
                                <div id="task-{{ $task->id }}">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                        {{ Form::text('taskName[]', $task->name, [
                                            'class' => 'form-control',
                                            'placeholder' => trans('settings.task_name'),
                                            'readonly' => true
                                        ]) }}
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <a class="btn btn-warning" title="{{ trans('settings.edit') }}" data-toggle="modal" data-target="#myModal{{ $task->id }}">
                                            <i class="fa fa-edit"></i> 
                                            {{ trans('settings.edit') }}
                                        </a>
                                        <a class="btn btn-danger btnDeleteTask" task="{{ $task->id }}"  title="{{ trans('settings.delete') }}">
                                            <i class="fa fa-trash-o"></i> 
                                            {{ trans('settings.delete') }}
                                        </a>
                                    </div>
                                    <!-- Modal update-->
                                    <div class="modal fade" id="myModal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    <h4 class="modal-title" id="myModalLabel">{{ trans('settings.edit') }} {{ trans('settings.task') }} </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="error"></div>
                                                    <input type="hidden" id="subject-id" value="{{ $subject->id }}" />
                                                    <div class="form-group">
                                                        {{ Form::text('task.name', $task->name, [
                                                            'class' => 'form-control',
                                                            'placeholder' => trans('settings.task_name'),
                                                            'id' => 'name-' . $task->id
                                                        ]) }}
                                                    </div>
                                                    <div class="form-group">
                                                        {{ Form::textarea('task.description', $task->description, [
                                                            'class' => 'form-control', 
                                                            'placeholder' => trans('settings.task_description'),
                                                            'rows' => 4,
                                                            'id' => 'description-' . $task->id
                                                        ]) }}
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('settings.close') }}</button>
                                                    <button type="button" task="{{ $task->id }}" class="btn btn-primary btnUpdateTask"> {{ trans('settings.update') }}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    {{ Form::submit(trans('settings.update'), [
                        'class' => 'btn btn-primary'
                    ]) }}
                    {{ Form::button(trans('settings.cancel'), [
                        'class' => 'btn btn-default',
                        'type' => 'reset'
                    ]) }}
                </div>
                {!! Form::close() !!}
                <!-- Form add -->
                {{ Form::open([
                    'route' => 'admin.task.store', 
                    'name' => 'formAddTask', 
                    'method' => 'POST'
                ]) }}
                <!-- Modal -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="myModalLabel">{{ trans('settings.add_task') }} </h4>
                            </div>
                            <div class="modal-body">
                                <div class="error"></div>
                                <input type="hidden" name="subject_id" value="{{ $subject->id }}" />
                                <div class="form-group">
                                    {{ Form::text('name', null, [
                                        'class' => 'form-control',
                                        'placeholder' => trans('settings.task_name')
                                    ]) }}
                                </div>
                                <div class="form-group">
                                    {{ Form::textarea('description', null, [
                                        'class' => 'form-control', 
                                        'placeholder' => trans('settings.task_description'),
                                        'rows' => 4
                                    ]) }}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('settings.close') }}</button>
                                <button type="button" class="btn btn-primary btnAddTask"> {{ trans('settings.create') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var taskName = '{{ trans('settings.task_name') }}';
    var taskDescription = '{{ trans('settings.task_description') }}';
    var taskDelete = '{{ trans('settings.delete_task') }}';
    var confirm_delete = '{{ trans('settings.confirm_delete') }}';
</script>
{{ Html::script('js/admin-event.js') }}
@endsection