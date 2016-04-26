@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>{{ trans('settings.subject') }}</h2>
            </div>
            <div class="col-md-2 col-md-offset-6 text-right">
                <a title="{{ trans('settings.create') }}" class="btn btn-primary" href="{{ route('admin.subject.create') }}">
                    <i class="fa fa-plus"></i> {{ trans('settings.create') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th width="70">﻿#</th>
                            <th>{{ trans('settings.name') }}</th>
                            <th>{{ trans('settings.description') }}</th>
                            <th width="70">{{ trans('settings.status') }}</th>
                            <th width="200">{{ trans('settings.task') }}</th>
                            <th width="200">{{ trans('settings.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subjects as $subject)
                        <tr>
                            <td width="70">﻿
                                {{ $subject->id }}
                            </td>
                            <td>
                                <a title="View subject" href="{{ route('admin.subject.show', $subject->id) }}">{{ $subject->name }}</a>
                            </td>
                            <td>
                                {{ str_limit($subject->description, 40) }}
                            </td>
                            <td width="70" class="text-center">
                                @if ($subject->isStart())
                                    <span class="label label-default">Start</span>
                                @elseif ($subject->isTraining())
                                    <span class="label label-primary">Training</span>
                                @else
                                    <span class="label label-danger">Finish</span>
                                @endif

                            </td>
                            <td width="200">
                                {{ trans('settings.there_are') }} 
                                {{ count($subject->tasks) }} 
                                {{ trans('settings.task') }}
                            </td>
                            <td width="170">
                                <a class="btn btn-warning" title="{{ trans('settings.edit') }}" href="{{ route('admin.subject.edit', $subject->id) }}">
                                    <i class="fa fa-edit"></i> 
                                    {{ trans('settings.edit') }}
                                </a>

                                {{ Form::open([
                                    'method' => 'DELETE', 
                                    'class' => 'form-inline',
                                    'route' => ['admin.subject.destroy', $subject->id]
                                ]) }}
                                    {{ Form::button("<i class=\"fa fa-trash-o\"></i> " . trans('settings.delete'), [
                                        'class' => 'btn btn-danger',
                                        'onclick' => "return confirm('" . trans('settings.confirm_delete') . "')",
                                        'type' => 'submit',
                                    ]) }}
                                {{ Form::close() }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">{!! $subjects->links() !!}</div>
            </div>
        </div>

    </div>
</div>

@endsection

@section('js')
{{ Html::script('js/admin-event.js') }}
@endsection