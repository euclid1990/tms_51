@extends('layouts.app')
@section('title') {{ trans('settings.title') }} @stop
@section('content')

<div class="container-fluid">
    <div class="container">
      <h1 class="page-header">{{ trans('settings.edit_profile') }}</h1>
      <div class="row">
        {!! Form::open([
            'route' => ['user.update', $user->id], 
            'name' => 'formUpdate', 
            'method' => 'PUT', 
            'class' => 'form-horizontal', 
            'role' => 'form',
            'files' => true
        ]) !!}
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="text-center">
                <img src="{{ $user->avatar }}" class="img-circle">
                <br /> <br />
                {!! Form::file('avatar', [
                    'class' => 'text-center center-block well well-sm', 
                    'id' => 'avatar'
                ]) !!}
            </div>
        </div>

        <div class="col-md-6 col-sm-6 col-xs-12 personal-info">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    {{ Form::label('name', trans('settings.name'), [
                        'class' => 'col-lg-3 control-label'
                    ]) }}
                    <div class="col-lg-8">
                        {!! Form::text('name', old('name', isset($user) ? $user['name'] : null), [
                            'class' => 'form-control', 
                            'id' => 'name'
                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('email', trans('settings.email'), [
                        'class' => 'col-lg-3 control-label'
                    ]) }}
                    <div class="col-lg-8">
                        {!! Form::text('email', old('email', isset($user) ? $user['email'] : null), [
                            'class' => 'form-control', 
                            'id' => 'email'
                        ]) !!}
                    </div>
                </div>

                <div class="form-group">
                    {{ Form::label('password', trans('settings.password'), [
                        'class' => 'col-lg-3 control-label'
                    ]) }}
                    <div class="col-lg-8">
                        {!! Form::password('password', [
                            'class' => 'form-control', 
                            'id' => 'password', 
                            'placeholder' => trans('settings.empty_changepass')
                        ]) !!}
                    </div>  
                </div>

                <div class="form-group">
                    {{ Form::label('password', trans('settings.repeatpassword'), [
                        'class' => 'col-lg-3 control-label'
                    ]) }}
                    <div class="col-lg-8">
                        {!! Form::password('password_confirmation', [
                            'class' => 'form-control', 
                            'id' => 'password_confirmation', 
                            'placeholder' => trans('settings.empty_changepass')
                        ]) !!}
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 control-label"></label>
                    <div class="col-md-8">
                        {{ Form::submit(trans('settings.save'), [
                            'class' => 'btn btn-primary'
                        ]) }}

                        <a class="btn btn-default" href="{{ route('user.show', $user->id) }}"> {{ trans('settings.cancel') }}</a>
                    </div>
                </div>
            </form>
        </div>
        {!! Form::close() !!}
    </div>
</div>
</div>
@endsection
