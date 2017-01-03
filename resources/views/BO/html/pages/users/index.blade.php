@extends('BO.layout')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
    <li class="active"><a href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
@endsection

@section('title', 'Utilisateurs')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Liste des utilisateurs</h4>
                    <div class="options">

                    </div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Date de naissance</th>
                            <th>Actif</th>
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
                                    <input type="checkbox" class="js-switch toggler-activate"
                                           data-id="{{ $user->id }}" data-token="{{ csrf_token() }}"
                                            {{ $user->is_active ? 'checked' : '' }} />
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection