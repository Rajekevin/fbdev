@extends('BO.layout')

@section('breadcrumb')
    <li class="active"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
@endsection

@section('title', 'Accueil')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a class="info-tiles tiles-toyo" href="{{ route('admin.users.index') }}">
                        <div class="tiles-heading">Utilisateurs</div>
                        <div class="tiles-body-alt">
                            <i class="fa fa-users"></i>
                            <div class="text-center"><span class="text-top"></span>{{ $countUsers }}</div>
                            <small>inscrits</small>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a class="info-tiles tiles-success" href="#">
                        <div class="tiles-heading">Photos</div>
                        <div class="tiles-body-alt">
                            <i class="fa fa-file-picture-o"></i>
                            <div class="text-center"><span class="text-top"></span>60<span class="text-smallcaps"></span></div>
                            <small>photos in contest</small>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a class="info-tiles tiles-orange" href="#">
                        <div class="tiles-heading">Votes</div>
                        <div class="tiles-body-alt">
                            <i class="fa fa-thumbs-up"></i>
                            <div class="text-center">109</div>
                            <small>votes registered</small>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection