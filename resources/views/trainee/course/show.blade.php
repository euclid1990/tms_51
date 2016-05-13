@extends('layouts.app')
@section('title') {{ trans('settings.title') }} @stop
@section('content')

<div class="container-fluid">
    <div class="container">
        <h2 class="tagline">{{ trans('settings.subject') }} </h2>
        <div class="row">
            <div class="col-lg-12 text-center">
                @foreach ($subjects as $subject)
                    @if (auth()->user()->subjects->find($subject->id)->isPivotStatusFinish()) 
                        <div class="col-md-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">
                                        {{ $subject->name }} 
                                        <div class="course-status">
                                            {!! auth()->user()->subjects->find($subject->id)->pivotStatus !!}
                                        </div>
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    {{ str_limit($subject->description, 69) }}
                                </div>
                            </div>
                        </div>
                    @else 
                        <a href="{{ route('subject.show', $subject->id) }}" title="{{ trans('settings.subject') }}">
                            <div class="col-md-4">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">
                                            {{ $subject->name }}
                                            <div class="course-status">
                                                 {!! auth()->user()->subjects->find($subject->id)->pivotStatus !!}
                                            </div>
                                        </h3>
                                    </div>
                                    <div class="panel-body">
                                        {{ str_limit($subject->description, 69) }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
        <hr class="small">
        <h2 class="tagline">{{ trans('settings.description') }} </h2>
        <div class="row">
            <div class="col-lg-12">
                <p class="lead">
                    {{ $course->description }}
                </p>
            </div>
        </div>
        <hr class="small">
        <h2 class="tagline"> {{ trans('settings.trainee') }} </h2>
        <div class="row">
            <div class="col-lg-12">
                <p class="lead">
                    @foreach ($trainees as $user)
                        <a href="{{ route('user.show', $user->id) }}" title="{{ trans('settings.profile') }}">
                            {{ $user->name }}
                        </a>,  
                    @endforeach
                </p>
            </div>
        </div>

        <hr class="small">
        <h2 class="tagline"> {{ trans('settings.activities') }} </h2>
        <div class="row">
            <div class="col-lg-12">
                <p class="lead">
                    @foreach ($activities as $activity) 
                        <strong>{{ $activity->user->name }}</strong>: {{ $activity->description }} - {{ $activity->created_at->diffForHumans() }}<br />
                    @endforeach
                    <div class="text-center">
                        {{ $activities->links() }}
                    </div>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection
