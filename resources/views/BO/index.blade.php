@extends('BO.layout')

@section('breadcrumb')
    <li class="active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
@endsection

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3 col-xs-12 col-sm-6">
                    <a class="info-tiles tiles-toyo" href="#">
                        <div class="tiles-heading">Users</div>
                        <div class="tiles-body-alt">
                            <i class="fa fa-users"></i>
                            <div class="text-center"><span class="text-top"></span>120</div>
                            <small>users registered</small>
                        </div>
                        <div class="tiles-footer">see all</div>
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
                        <div class="tiles-footer">see photos</div>
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
                        <div class="tiles-footer">see metrics</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection