<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Pardon Maman</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600' rel='stylesheet' type='text/css'>
    @section('stylesheet')
        <link rel="stylesheet" href="{{ asset('BO/css/main.css') }}">
    @show

    <script type="text/javascript" src="assets/js/less.js"></script>
</head>

<header class="navbar navbar-inverse navbar-fixed-top" role="banner">
    <a id="leftmenu-trigger" class="tooltips" data-toggle="tooltip" data-placement="right" title=""
       data-original-title="Toggle Sidebar"></a>
    <div class="navbar-header pull-left">
        <a class="navbar-brand" href="index.php">Pardon maman</a>
    </div>

    <ul class="nav navbar-nav pull-right toolbar">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown">
                <span class="hidden-xs">
                    {{ Auth::user()->firstname . ' ' . Auth::user()->lastname }}<i class="fa fa-caret-down"></i>
                </span>
                <img src="http://lorempicsum.com/simpsons/255/200/2" alt="Dangerfield"/>
            </a>
            <ul class="dropdown-menu userinfo arrow">
                <li class="username">
                    <a href="#">
                        <div class="pull-left">
                            <img src="http://lorempicsum.com/simpsons/255/200/2" alt="Jeff Dangerfield"/>
                        </div>
                        <div class="pull-right">
                            <h5>Howdy, {{ Auth::user()->firstname }}!</h5>
                        </div>
                    </a>
                </li>
                <li class="userlinks">
                    <ul class="dropdown-menu">
                        <li><a href="/logout" class="text-right">Sign Out</a></li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
</header>

<div id="page-container">
    <!-- BEGIN SIDEBAR -->
    <nav id="page-leftbar" role="navigation">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="acc-menu" id="sidebar">
            <li {{ Route::currentRouteName() === 'admin.dashboard' ? "class=active" : '' }}>
                <a href="{{ route('admin.dashboard') }}"><i class="fa fa-home"></i> <span>Dashboard</span></a>
            </li>
            <li {{ Route::currentRouteName() === 'admin.users.index' ? 'class=active' : '' }}>
                <a href="{{ route('admin.users.index') }}"><i class="fa fa-users"></i> <span>Users</span> </a>
            </li>
            <li {{ Route::currentRouteName() === 'admin.' ? 'class=active' : '' }}>
                <a href="#"><i class="fa fa-file-picture-o"></i> <span>Photos</span></a>
            </li>
            <li {{ Route::currentRouteName() === 'admin.' ? 'class=active' : '' }}>
                <a href="#"><i class="fa fa-gavel"></i> <span>Contest</span></a>
            </li>
            <li {{ Route::currentRouteName() === 'admin.' ? 'class=active' : '' }}>
                <a href="#"><i class="fa fa-line-chart"></i> <span>Metrics</span></a>
            </li>
            <li class="divider"></li>
            <li {{ Route::currentRouteName() === 'admin.' ? 'class=active' : '' }}>
                <a href="#"><i class="fa fa-edit"></i> <span>Pages</span></a>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </nav>
