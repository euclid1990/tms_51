@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>{{ trans('settings.edit_course') }}</h2>
                {{ Form::open([
                    'route' => ['admin.course.update', $course->id], 
                    'name' => 'formEditCourse', 
                    'method' => 'PUT'
                ]) }}
                <div class="form-group">
                    {{ Form::label('name', trans('settings.name')) }}
                    {{ Form::text('name', old('name', isset($course) ? $course->name : null), [
                        'class' => 'form-control', 
                        'id' => 'name'
                    ]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('description', trans('settings.description')) }}
                    {{ Form::textarea('description', old('description', isset($course) ? $course->description : null), [
                        'class' => 'form-control', 
                        'id' => 'description',
                        'rows' => 6
                    ]) }}
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ trans('settings.subject') }} </h3>
                        <div class="head-panel">
                            <a class="btn btn-success" title="{{ trans('settings.add_subject') }}" data-toggle="modal" data-target="#myModal">
                                <i class="fa fa-plus"></i> 
                                {{ trans('settings.add_subject') }}
                            </a>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                @foreach ($course->subjects as $subject)
                                <div id="course-subject-{{ $course->courseSubject($subject->id)->id }}">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                        {{ Form::text('subjectName[]', $subject->name, [
                                            'class' => 'form-control',
                                            'placeholder' => trans('settings.name'),
                                            'readonly' => true
                                        ]) }}
                                        </div>
                                    </div>
                                    <div class="col-md-3 text-right">
                                        <a class="btn btn-danger btnDeleteCourseSubject" course-subject="{{ $course->courseSubject($subject->id)->id }}"  title="{{ trans('settings.delete') }}">
                                            <i class="fa fa-trash-o"></i> 
                                            {{ trans('settings.delete') }}
                                        </a>
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
                    'route' => 'admin.course-subject.store', 
                    'name' => 'formAddSubject', 
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
                                <h4 class="modal-title" id="myModalLabel">{{ trans('settings.add_subject') }} </h4>
                            </div>
                            <div class="modal-body">
                                <div class="error"></div>
                                <input type="hidden" name="course_id" value="{{ $course->id }}" />
                                <div class="form-group">
                                    {{ Form::select('subject_id', $allSubject, null, [
                                        'class' => 'form-control'
                                    ]) }}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('settings.close') }}</button>
                                <button type="button" class="btn btn-primary btnAddSubject"> {{ trans('settings.create') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var confirm_delete = '{{ trans('settings.confirm_delete') }}';
</script>
{{ Html::script('js/admin-event.js') }}
@endsection