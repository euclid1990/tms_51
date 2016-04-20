@extends('layouts.app')
@section('title') {{ trans('settings.title') }} @stop
@section('content')
<!-- Home -->
<div class="intro-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="intro-message">
                    <h1>{{ trans('settings.company') }}</h1>
                    <h3>{{ trans('settings.title') }}</h3>
                    <hr class="intro-divider">
                    <ul class="list-inline intro-social-buttons">
                        <li>
                            <a href="https://www.facebook.com/FramgiaVietnam" target="_blank" title="Facebook" class="btn btn-default btn-lg">
                                <i class="fa fa-facebook fa-fw"></i> 
                                <span class="network-name">Facebook</span>
                            </a>
                        </li>

                        <li>
                            <a href="http://github.com/framgia" target="_blank" title="Github" class="btn btn-default btn-lg">
                                <i class="fa fa-github fa-fw"></i> 
                                <span class="network-name">Github</span>
                            </a>
                        </li>

                        <li>
                            <a href="http://recruit.framgia.vn/" target="_blank" title="Website" class="btn btn-default btn-lg">
                                <i class="fa fa-globe fa-fw"></i> 
                                <span class="network-name">Website</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container -->

</div>
<!-- /.intro-header -->
@if (Auth::guest())

<script>
    var register = '{{ trans('settings.register') }}';
    var registerWith = '{{ trans('settings.registerwith') }}';
    var login = '{{ trans('settings.login') }}';
    var loginWith = '{{ trans('settings.loginwith') }}';
</script>

<!-- Modal login and register  -->
<div class="modal fade login" id="loginModal">
    <div class="modal-dialog login animated">
        <div class="modal-content">
            <div class="modal-header">
                {{ Form::button('&times;', ['class' => 'close', 'data-dismiss' => 'modal', 'aria-hidden' => 'true']) }}
                <h4 class="modal-title center">{{ trans('settings.login') }} </h4>
            </div>
            <div class="modal-body">  
                <div class="box">
                    <div class="content">
                        <div class="social">
                            <div class="division">
                                <span class="with">{{ trans('settings.loginwith') }}</span>
                            </div>
                            <a id="facebook_login" class="circle facebook" href="{{ url('login/facebook') }}">
                                <i class="fa fa-facebook fa-fw"></i>
                            </a>

                            <a id="google_login" class="circle google" href="{{ url('login/google') }}">
                                <i class="fa fa-google-plus fa-fw"></i>
                            </a>

                            <a class="circle github" href="{{ url('login/github') }}">
                                <i class="fa fa-github fa-fw"></i>
                            </a>

                        </div>
                        <div class="division">
                            <div class="line l"></div>
                            <span>{{ trans('settings.or') }}</span>
                            <div class="line r"></div>
                        </div>
                        <div class="error"></div>
                        <div class="form loginBox">
                            {!! Form::open(['route' => 'login', 'name' => 'frmLogin', 'method' => 'POST']) !!}

                            {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => trans('settings.email')]) !!}

                            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => trans('settings.password')]) !!}

                            {{ Form::button("<i class=\"fa fa-btn fa-sign-in\"></i> " . trans('settings.login'), [
                                'class' => 'btn btn-default btn-login', 
                                'type' => 'submit'
                            ]) }}

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="content registerBox" style="display:none;">
                        <div class="error-register"></div>
                        <div class="form">
                            {!! Form::open(['route' => 'register', 'name' => 'frmRegister', 'method' => 'POST']) !!}

                            {!! Form::text('name', null, ['class' => 'form-control', 'id' => 'name', 'placeholder' => trans('settings.name')]) !!}

                            {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => trans('settings.email')]) !!}

                            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => trans('settings.password')]) !!}


                            {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password_confirmation', 'placeholder' => trans('settings.repeatpassword')]) !!}

                            {{ Form::button("<i class=\"fa fa-btn fa-user\"></i> " . trans('settings.register'), [
                                'class' => 'btn btn-default btn-register', 
                                'type' => 'submit'
                            ]) }}

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="forgot login-footer">
                    <span class="fleft">
                        <a href="#" id="showregister">{{ trans('settings.showregister') }}</a>
                    </span>

                    <span class="fright">
                        <a href="#">{{ trans('settings.fogotpass') }}</a>
                    </span>

                </div>
                <div class="forgot register-footer" style="display:none">
                    <span>{{ trans('settings.showlogin') }}</span>
                    <a href="#" id="showlogin" >{{ trans('settings.login') }}</a>
                </div>
            </div>        
        </div>
    </div>
</div>
@endif

@endsection
