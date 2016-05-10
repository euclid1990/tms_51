@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <h2>{{ trans('settings.add_trainee') }}</h2>
                {{ Form::open([
                    'route' => 'admin.user.store', 
                    'name' => 'formAddUser', 
                    'method' => 'POST'
                ]) }}
                <div class="form-group">
                    {{ Form::label('name', trans('settings.name')) }}
                    {{ Form::text('name', old('name'), [
                        'class' => 'form-control', 
                        'id' => 'name'
                    ]) }}
                </div>
                <div class="form-group">
                    {{ Form::label('email', trans('settings.email')) }}
                    {!! Form::email('email', old('email'), [
                        'class' => 'form-control', 
                        'id' => 'email',
                    ]) !!}
                </div>
                <div class="form-group">
                    {{ Form::label('avatar', trans('settings.avatar')) }}
                    {!! Form::file('avatar', [
                        'class' => 'form-control',
                        'id' => 'avatar'
                    ]) !!}
                </div>
                <div class="form-group">
                    {{ Form::label('password', trans('settings.password')) }}
                    {!! Form::password('password', [
                        'class' => 'form-control', 
                        'id' => 'password',
                    ]) !!}
                </div>
                <div class="form-group">
                    {{ Form::label('password_confirmation', trans('settings.repeatpassword')) }}
                    {!! Form::password('password_confirmation', [
                        'class' => 'form-control', 
                        'id' => 'password_confirmation',
                    ]) !!}
                </div>
                <div class="form-group text-center">
                    {{ Form::submit(trans('settings.create'), [
                        'class' => 'btn btn-primary'
                    ]) }}
                    {{ Form::button(trans('settings.cancel'), [
                        'class' => 'btn btn-default',
                        'type' => 'reset'
                    ]) }}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
