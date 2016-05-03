@extends('layouts.app')

@section('css')
    {{ Html::style('bower_components/bootstrap-select/dist/css/bootstrap-select.min.css') }}
@endsection

@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>{{ trans('settings.add_course') }}</h2>
                {{ Form::open([
                    'route' => 'admin.course.store', 
                    'name' => 'formAddCourse', 
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
                <div class="form-group">
                    {{ Form::label('subject_id', trans('settings.subject')) }}
                    {!! Form::select('subject_id[]', $subject, null,  [
                        'class' => 'form-control selectpicker', 
                        'multiple' => 'multiple'
                    ]) !!}
                </div>
                <div class="form-group text-center">
                    {{ Form::submit(trans('settings.create'), [
                        'class' => 'btn btn-primary'
                    ]) }}
                    {{ Form::button(trans('settings.cancel'), [
                        'class' => 'btn btn-default',
                        'type' => 'reset'
                    ]) }}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    {{ Html::script('js/admin-event.js') }}
    {{ Html::script('bower_components/bootstrap-select/dist/js/bootstrap-select.min.js') }}
@endsection

