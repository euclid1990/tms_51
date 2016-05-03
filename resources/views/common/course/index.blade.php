@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>{{ trans('settings.course') }}</h2>
            </div>
            <div class="col-md-2 col-md-offset-6 text-right">
                <a title="{{ trans('settings.create') }}" class="btn btn-primary" href="{{ route('admin.course.create') }}">
                    <i class="fa fa-plus"></i> {{ trans('settings.create') }}
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>﻿#</th>
                            <th>{{ trans('settings.name') }}</th>
                            <th>{{ trans('settings.description') }}</th>
                            <th>{{ trans('settings.status') }}</th>
                            <th>{{ trans('settings.subject') }}</th>
                            <th>{{ trans('settings.action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                        <tr>
                            <td>﻿
                                {{ $course->id }}
                            </td>
                            <td>
                                <a title="View course" href="{{ route('admin.course.show', $course->id) }}">{{ $course->name }}</a>
                            </td>
                            <td>
                                {{ str_limit($course->description, 40) }}
                            </td>
                            <td class="text-center">
                                @if ($course->isStart())
                                    <span class="label label-default">{{ trans('settings.start') }}</span>
                                @elseif ($course->isTraining())
                                    <span class="label label-primary">{{ trans('settings.training') }}</span>
                                @else
                                    <span class="label label-danger">{{ trans('settings.finish') }}</span>
                                @endif

                            </td>
                            <td>
                                {{ trans('settings.there_are') }} 
                                {{ count($course->subjects) }} 
                                {{ trans('settings.subject') }}
                            </td>
                            <td>
                                <a class="btn btn-warning" title="{{ trans('settings.edit') }}" href="{{ route('admin.course.edit', $course->id) }}">
                                    <i class="fa fa-edit"></i> 
                                    {{ trans('settings.edit') }}
                                </a>

                                {{ Form::open([
                                    'method' => 'DELETE', 
                                    'class' => 'form-inline',
                                    'route' => ['admin.course.destroy', $course->id]
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
                <div class="text-center">{!! $courses->links() !!}</div>
            </div>
        </div>
    </div>
</div>
@endsection
