@extends('layouts.app')
@section('title') {{ trans('settings.title') }} @stop
@section('content')

<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 class="tagline">
                @if (Auth::user()->can('updateUser', $user)) 
                    {{ trans('settings.my_profile') }}
                @else 
                    {{ trans('settings.profile') }}
                @endif
                </h2>
            </div>
            @if (Auth::user()->can('updateUser', $user)) 
            <div class="col-md-offset-4 col-md-2">
                <a href="{{ url('user/' . $user->id . '/edit') }}" class="btn btn-primary">
                    <i class="fa fa-pencil"></i> 
                    {{ trans('settings.edit') }}
                </a>
            </div>
            @endif
            
        </div>

        <hr class="small" />
        <div class="row">
            <div class="col-lg-12">
                <div class="col-md-3">
                    <img src="{{ $user->avatar }}" class="img-thumb img-circle">
                </div>
                <div class="col-md-9">
                    <table class="table">
                        <tr>
                            <td>{{ trans('settings.name') }}: </td>
                            <td colspan="2">{{ $user->name }} </td>
                        </tr>

                        <tr>
                            <td>{{ trans('settings.email') }}: </td>
                            <td colspan="2">{{ $user->email }} </td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
