<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $neighborhood->id }}</p>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    <p>{{ $neighborhood->name }}</p>
</div>

<!-- Code Field -->
<div class="form-group">
    {!! Form::label('code', 'Code:') !!}
    <p>{{ $neighborhood->code }}</p>
</div>

<!-- Municipality Id Field -->
<div class="form-group">
    {!! Form::label('municipality_id', 'Municipality Id:') !!}
    <p>{{ $neighborhood->municipality_id }}</p>
</div>

