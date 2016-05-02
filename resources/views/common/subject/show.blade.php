@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="col-md-10 col-md-offset-1">
            <div class="col-md-4">
                <h2>{{ trans('settings.show_subject') }}</h2>
            </div>
            <div class="col-md-2 col-md-offset-6">
                <a title="{{ trans('settings.create') }}" class="btn btn-warning" href="{{ route('admin.subject.edit', $subject->id) }}">
                    <i class="fa fa-edit"></i> {{ trans('settings.edit') }}
                </a>
            </div>
        </div>        
        <div class="col-md-10 col-md-offset-1 ">
            <div class="form-group">
                <div class="col-sm-3">
                    {{ Form::label('name', trans('settings.name')) }}
                </div>
                <div class="col-sm-9">
                    {{ Form::label('name', old('name', isset($subject) ? $subject->name : null)) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3">
                {{ Form::label('description', trans('settings.description')) }}
                </div>
                <div class="col-sm-9">
                {{ Form::label('description', old('description', isset($subject) ? $subject->description : null)
                ) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-3">
                    {{ Form::label('status', trans('settings.status')) }}
                </div>
                <div class="col-sm-9">
                    @if ($subject->isStart())
                        <span class="label label-default">Start</span>
                    @elseif ($subject->isTraining())
                        <span class="label label-primary">Training</span>
                    @else
                        <span class="label label-danger">Finish</span>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
