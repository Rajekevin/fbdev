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
    <div class="navbar-header pull-left">
        <a class="navbar-brand" href="index.php">Avant</a>
    </div>

    <ul class="nav navbar-nav pull-right toolbar">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown"><span
                        class="hidden-xs">John McCartney <i class="fa fa-caret-down"></i></span><img
                        src="assets/demo/avatar/dangerfield.png" alt="Dangerfield"/></a>
            <ul class="dropdown-menu userinfo arrow">
                <li class="username">
                    <a href="#">
                        <div class="pull-left"><img src="assets/demo/avatar/dangerfield.png" alt="Jeff Dangerfield"/>
                        </div>
                        <div class="pull-right"><h5>Howdy, John!</h5>
                            <small>Logged in as <span>john275</span></small>
                        </div>
                    </a>
                </li>
                <li class="userlinks">
                    <ul class="dropdown-menu">
                        <li><a href="#">Edit Profile <i class="pull-right fa fa-pencil"></i></a></li>
                        <li><a href="#">Account <i class="pull-right fa fa-cog"></i></a></li>
                        <li><a href="#">Help <i class="pull-right fa fa-question-circle"></i></a></li>
                        <li class="divider"></li>
                        <li><a href="#" class="text-right">Sign Out</a></li>
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
            <li class="active"><a href="/admin"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            <li><a href="#"><i class="fa fa-users"></i> <span>Users</span> </a></li>
            <li><a href="#"><i class="fa fa-file-picture-o"></i> <span>Photos</span></a></li>
            <li><a href="#"><i class="fa fa-gavel"></i> <span>Contest</span></a></li>
            <li><a href="#"><i class="fa fa-line-chart"></i> <span>Metrics</span></a>
            <li class="divider"></li>
            <li><a href="#"><i class="fa fa-edit"></i> <span>Pages</span></a></li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </nav>
