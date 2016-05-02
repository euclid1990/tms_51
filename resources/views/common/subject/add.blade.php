@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>{{ trans('settings.add_subject') }}</h2>
                {{ Form::open([
                    'route' => 'admin.subject.store', 
                    'name' => 'formAddSubject', 
                    'method' => 'POST'
                ]) }}
                <div class="form-group">
                    {{ Form::label('name', trans('settings.name')) }}
                    {{ Form::text('name', old('name'), [
                        'class' => 'form-control', 
                        'id' => 'name'
                    ]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('description', trans('settings.description')) }}
                    {!! Form::textarea('description', old('description'), [
                        'class' => 'form-control', 
                        'id' => 'description',
                        'rows' => 6
                    ]) !!}
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('settings.task') }} </h3>
                    </div>
                    <div class="panel-body">
                        <div id="itemRows">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                        {{ Form::text('taskName[]', null, [
                                            'class' => 'form-control',
                                            'placeholder' => trans('settings.task_name')
                                        ]) }}
                                        </div>
                                        <div class="form-group">
                                        {{ Form::textarea('taskDescription[]', null, [
                                            'class' => 'form-control', 
                                            'placeholder' => trans('settings.task_description'),
                                            'rows' => 4
                                        ]) }}
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <input id="addRow" type="button" value="{{ trans('settings.add_task') }}" class="btn btn-primary" /> 
                                    </div>
                                </div>
                            </div>
                            <div class="template hidden">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="col-md-10">
                                            <div class="form-group"> 
                                                <input class="form-control" placeholder="{{ trans('settings.task_name') }}"  type="text"> 
                                            </div>
                                            <div class="form-group"> 
                                                <textarea class="form-control" rows="4" placeholder="{{ trans('settings.task_description') }}" cols="50"></textarea>
                                            </div>    
                                        </div>
                                        <div class="col-md-2">
                                            <input type="button" value="{{ trans('settings.delete_task') }}" class="btn btn-warning btnDelete">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group text-center">
                    {{ Form::submit(trans('settings.create'), [
                        'class' => 'btn btn-primary'
                    ]) }}
                    {{ Form::button(trans('settings.cancel'), [
                        'class' => 'btn btn-default'
                    ]) }}
                </div>
                {!! Form::close() !!}
            </div>
            <hr class="small" />
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var taskName = '{{ trans('settings.task_name') }}';
    var taskDescription = '{{ trans('settings.task_description') }}';
    var taskDelete = '{{ trans('settings.delete_task') }}';
</script>
{{ Html::script('js/admin-event.js') }}
@endsection