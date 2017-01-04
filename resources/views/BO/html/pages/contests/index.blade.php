@extends('BO.layout')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
    <li class="active"><a href="{{ route('admin.contests.index') }}">Concours</a></li>
@endsection

@section('title', 'Concours')

@section('content')
    <a href="{{ route('admin.contests.create') }}" class="btn btn-default">
        <i class="fa fa-plus"></i>Ajouter un concour
    </a>
    <br>
    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h4>Liste des concours</h4>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Label</th>
                            <th>Débute le</th>
                            <th>Fini le</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($contests as $contest)
                            <tr>
                                <td>{{ $contest->id }}</td>
                                <td>{{ $contest->label }}</td>
                                <td>{{ $contest->begin_at }}</td>
                                <td>{{ $contest->end_at }}</td>
                                <td>
                                    <a href="{{ route('admin.contests.show', $contest->id) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                    <form action="{{ route('admin.contests.destroy', $contest->id) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection