<h2>Formulaire</h2>

{!! Form::open(['route' => 'participate_success', 'class' => 'contact-form'])  !!}
    {{ Form::hidden('link', $tmp_photo) }}
    <div class="input-field">
        {{ Form::label('title', 'Titre') }}
        {{ Form::text('title'), ['name'=> 'ipt-title', 'id' => 'ipt-title', 'autocomplete' => 'off'] }}
    </div>
    <div class="input-field">
        {{ Form::label('author', 'Auteur') }}
        {{ Form::text('author'), ['id' => 'ipt-author', 'autocomplete' => 'off'] }}
    </div>
    <div class="input-field">
        {{ Form::label('location', 'Lieu') }}
        {{ Form::text('location'), ['id' => 'ipt-location', 'autocomplete' => 'off']}}
    </div>
    <div class="input-field input-textarea">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description'), ['id' => 'ipt-description'] }}
    </div>
    <div class="input-field">
        {{  Form::submit('Envoyer', ['class' => 'btn-submit']) }}
    </div>
{!! Form::close() !!}