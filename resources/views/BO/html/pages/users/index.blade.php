@extends('BO.layout')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Users</a></li>
    <li class="active"><a href="{{ route('admin.user.index') }}">Users</a></li>
@endsection

@section('title', 'Users')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Striped Tables</h4>
                    <div class="options">

                    </div>
                </div>
                <div class="panel-body">
                    <p>Adds zebra-striping to any table row within <code>&lt;tbody&gt;</code> by adding the <code>.table-striped</code>
                        to the base class</p>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Birthday</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>1</td>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection