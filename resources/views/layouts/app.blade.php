<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title', trans('settings.title'))</title>
    <!-- Bootstrap Core CSS -->
    {{ Html::style('bower_components/bootstrap/dist/css/bootstrap.css') }}
    {{ Html::style('css/landing-page.css') }}
    {{ Html::style('css/login-register.css') }}
    <!-- Custom Fonts -->
    {{ Html::style('bower_components/font-awesome/css/font-awesome.css') }}
    <!-- Custom css -->
    @yield('css')
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <meta name="_token" content="{{ csrf_token() }}">
    <script>
        //get baseURL website
        var baseURL = {!! json_encode(url('/')) !!};
    </script>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand"  href="{{ url('/') }}"> TMS 51</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                @if (!Auth::guest())
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ route('home') }}" title="{ trans('settings.home') }}">{{ trans('settings.home') }}</a>
                        </li>
                        @if (Auth::user()->isSupervisor())
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="">{{ trans('settings.course') }} <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('admin.course.create') }}"><i class="fa fa-fw fa-plus"></i>  {{ trans('settings.create') }} </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('admin.course.index') }}"><i class="fa fa-fw fa-bars"></i>  {{ trans('settings.list') }} </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="">{{ trans('settings.subject') }} <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('admin.subject.create') }}"><i class="fa fa-fw fa-plus"></i>  {{ trans('settings.create') }} </a>
                                    </li>

                                    <li>
                                        <a href="{{ route('admin.subject.index') }}"><i class="fa fa-fw fa-bars"></i>  {{ trans('settings.list') }} </a>
                                    </li>
                                </ul>
                            </li>

                        @endif
                    </ul>
                    
                @endif

                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::guest())

                    <li>
                        <a href="#" title="" id="register" data-toggle="modal">  {{ trans('settings.register') }} </a>
                    </li>

                    <li>
                        <a href="#" title="" id="login" data-toggle="modal"> {{ trans('settings.login') }} </a>
                    </li>

                    @else

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <img alt="{{ Auth::user()->name  }}" src="{{ Auth::user()->avatar }}" width="20" class="avatar" height="20"> <i class="fa fa-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu dropdown-user">
                            <li>
                                <a>{{ trans('settings.signed') }} <span class="bold">{{ Auth::user()->name }} </span>
                                </a> 
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="{{ url('user') . '/' . Auth::user()->id }}"><i class="fa fa-user fa-fw"></i> {{ trans('settings.profile') }} </a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}"><i class="fa fa-sign-out fa-fw"></i> {{ trans('settings.logout') }}</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>

                    @endif

                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <div class="top-gap"></div>
    @include('layouts.messages')
    @include('layouts.errors')
    @yield('content')

    <!-- Footer -->
    <footer>
        <div class="container center">
            <div class="row ">
                <div class="col-lg-12">
                    <ul class="list-inline center">
                        <li>
                            {{ trans('settings.language') }}: 
                        </li>
                        <li>
                            <a href="{{ route('lang', 'en') }}">{{ trans('settings.english') }}</a>
                        </li>

                        <li class="footer-menu-divider">&sdot;</li>

                        <li>
                            <a href="{{ route('lang', 'vi') }}">{{ trans('settings.vietnamese') }}</a>
                        </li>                        

                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    {{ HTML::script('bower_components/jquery/dist/jquery.js') }}
    <!-- Bootstrap Core JavaScript -->
    {{ HTML::script('bower_components/bootstrap/dist/js/bootstrap.js') }}
    <!-- Login and Register JavaScript -->
    {{ HTML::script('js/login-register.js') }}
    <!-- Custom JavaScript -->
    @yield('js')
    
</body>
</html>