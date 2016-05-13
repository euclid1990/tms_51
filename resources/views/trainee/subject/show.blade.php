@extends('layouts.app')
@section('title') {{ trans('settings.title') }} @stop
@section('content')

<div class="container-fluid">
    <div class="container">
        <h2 class="tagline"> {{ trans('settings.subject') }}: {{ $subject->name }}</h2>
        <div class="row">
            <div class="col-lg-12">
            <div class="error"></div>
            <div class="message alert alert-success hidden"></div>
            @foreach ($tasks as $task)
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            {{ $task->name }} 
                        </div>
                        <div class="panel-body text-center">
                            <a class="btn btn-primary" data-toggle="modal" data-target="#modal{{ $task->id }}">
                                {{ trans('settings.view_task') }}
                            </a>
                        </div>
                        <div class="panel-footer">
                            <div class="checkbox text-center">
                                <label>
                                    {!! $task->checkboxStatus !!}
                                </label>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="modal{{ $task->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title" id="myModalLabel"> {{ trans('settings.task_description') }}</h4>
                                    </div>
                                    <div class="modal-body">
                                        {{ $task->description }}
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>
        <h2 class="tagline"> {{ trans('settings.description') }}:  </h2>
        <div class="row">
            <p class="lead">
                {{ $subject->description }}
            </p>
        </div>
        <h2 class="tagline">{{ trans('settings.activities') }} </h2>
        <div class="row">
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

@endsection

@section('js')

    <script>
        var finish_task = '{{ trans('settings.finish_task') }}';
    </script>
    {{ Html::script('js/user-event.js') }}
@endsection
