@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h2>{{ trans('settings.trainee') }}</h2>
            </div>
            <div class="col-md-2 col-md-offset-6 text-right">
                @if (Auth::user()->isSupervisor()) 
                    <a title="{{ trans('settings.create') }}" class="btn btn-primary" href="{{ route('admin.user.create') }}">
                        <i class="fa fa-plus"></i> {{ trans('settings.create') }}
                    </a>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>﻿#</th>
                            <th>{{ trans('settings.name') }}</th>
                            <th>{{ trans('settings.email') }}</th>
                            <th>{{ trans('settings.avatar') }}</th>
                            @if (Auth::user()->isSupervisor()) 
                                <th class="user-action">{{ trans('settings.action') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                        <tr>
                            <td>﻿
                                {{ $key + 1 }}
                            </td>
                            <td>
                            <a title="{{ trans('settings.trainee') }}" href="{{ route('user.show', $user->id) }}">{{ $user->name }}</a>
                            </td>
                            <td>
                                {{ $user->email }}
                            </td>
                            <td class="text-center">
                                <img src="{{ $user->avatar }}" class="img-user" />
                            </td>
                            @if (Auth::user()->isSupervisor()) 
                            <td class="user-action">
                                <a class="btn btn-warning" title="{{ trans('settings.edit') }}" href="{{ route('user.edit', $user->id) }}">
                                    <i class="fa fa-edit"></i> 
                                </a>
                                {{ Form::open([
                                    'method' => 'DELETE', 
                                    'class' => 'form-inline',
                                    'route' => ['admin.user.destroy', $user->id]
                                ]) }}
                                    {{ Form::button("<i class=\"fa fa-trash-o\"></i>", [
                                        'class' => 'btn btn-danger',
                                        'onclick' => "return confirm('" . trans('settings.confirm_delete') . "')",
                                        'type' => 'submit',
                                    ]) }}
                                {{ Form::close() }}
                            </td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="text-center">{!! $users->links() !!}</div>
            </div>
        </div>
    </div>
</div>
@endsection
