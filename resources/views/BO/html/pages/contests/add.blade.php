@extends('BO.layout')

@section('breadcrumb')
    <li><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
    <li><a href="{{ route('admin.contests.index') }}">Concours</a></li>
    <li class="active"><a href="{{ route('admin.contests.create') }}">Ajouter</a></li>
@endsection

@section('meta-title')
    Pardon maman | ajouter concour
@endsection

@section('title', 'Ajouter un concour')

@section('content')
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-xs-12">
            <div class="panel panel-midnightblue">
                <div class="panel-heading">
                    <h4>Ajouter un concour</h4>
                </div>
                <div class="panel-body collapse in">
                    <form action="{{ route('admin.contests.store') }}" method="post"
                          class="form-horizontal row-border" enctype="multipart/form-data">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="label" class="col-sm-3 control-label">Libellé du concours</label>
                            <div class="col-sm-6">
                                <input type="text" name="label" class="form-control" placeholder="Libellé">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-6">
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="short" class="col-sm-3 control-label">Description courte</label>
                            <div class="col-sm-6">
                                <textarea name="short" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reward" class="col-sm-3 control-label">Récompense</label>
                            <div class="col-sm-6">
                                <textarea name="reward"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="beginAt" class="col-sm-3 control-label">Débute le</label>
                            <div class="col-sm-6">
                                <input type="text" name="beginAt" class="form-control" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endAt" class="col-sm-3 control-label">Fini le</label>
                            <div class="col-sm-6">
                                <input type="text" name="endAt" class="form-control" placeholder="Y-m-d">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label">Image de couverture</label>
                            <div class="col-sm-6">
                                <input type="file" name="cover">
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-3">
                                    <div class="btn-toolbar">
                                        <button class="btn-primary btn">Submit</button>
                                        <button class="btn-default btn">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection