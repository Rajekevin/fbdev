@extends('BO.layout')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Users</a></li>
    <li class="active"><a href="{{ route('admin.users.index') }}">Users</a></li>
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
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Birthday</th>
                            <th>Active</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->firstname }}</td>
                                <td>{{ $user->lastname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->birthday }}</td>
                                <td>
                                    <input type='checkbox' data-toggle-position='right' data-toggle-color='#f00' />
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection