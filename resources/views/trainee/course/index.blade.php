@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="container">
        <h2 class="tagline">{{ trans('settings.course') }}</h2>
        <hr class="small" />
        <div class="row">
            <div class="col-lg-12">
            @foreach ($courses as $course)
                @if ($course->isPivotStatusFinish()) 
                    <div class="col-md-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">
                                    {{ $course->name }} 
                                    <div class="course-status">
                                        {!! $course->pivotStatus !!}
                                    </div>
                                </h3>
                            </div>
                            <div class="panel-body">
                                {{ str_limit($course->description, 69) }}
                            </div>
                        </div>
                    </div>
                @else 
                    <a href="{{ route('course.show', $course->id) }}" title="{{ trans('settings.course') }}">
                        <div class="col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        {{ $course->name }}
                                        <div class="course-status">
                                            {!! $course->pivotStatus !!}
                                        </div>
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    {{ str_limit($course->description, 69) }}
                                </div>
                            </div>
                        </div>
                    </a>
                @endif
            @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
