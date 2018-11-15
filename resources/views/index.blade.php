<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', '公众号小程序后台')</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.2 -->
        <link href="/bower/AdminLTE/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!-- Font Awesome -->
        <link rel="stylesheet" href="/bower/font-awesome/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="/bower/Ionicons/css/ionicons.min.css">
        <!-- style.min.css -->
        <link rel="stylesheet" href="/css/style.min.css">
        <!-- Theme style -->
        <link href="/bower/AdminLTE/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css"/>
        <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
              page. However, you can choose any other skin. Make sure you
              apply the skin class to the body tag so the changes take effect.
        -->
        <link href="/bower/AdminLTE/dist/css/skins/skin-blue.min.css" rel="stylesheet" type="text/css"/>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="/bower/html5shiv/dist/html5shiv.min.js"></script>
        <script src="/bower/respond/dest/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="../../index2.html"><b>TQY</b> - 公众号小程序</a>
            </div>
            <!-- /.login-logo -->
            <div class="login-box-body">
                <form action="{{ route('admin.auth.login.post') }}" method="POST">
                    {{ csrf_field() }}
                    @include('admin.common.errors', ['errors'=>$errors])
                    <div class="form-group has-feedback">
                        {{-- <input type="email" class="form-control" placeholder="Email"> --}}
                        <input type="text" name="username" class="form-control" placeholder="用户名" value="{{old('username')}}" required>
                        <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password"  name="password" class="form-control" placeholder="密码" required>
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    </div>
                    <div class="row">
                        <div class="col-xs-8">
                        </div>
                        <!-- /.col -->
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">登陆</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.login-box-body -->
        </div>
        <!-- /.login-box -->
    </body>
</html>
