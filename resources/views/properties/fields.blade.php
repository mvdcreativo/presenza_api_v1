<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_id', 'Status Id:') !!}
    {!! Form::text('status_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Property Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('property_type_id', 'Property Type Id:') !!}
    {!! Form::text('property_type_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Neighborhood Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('neighborhood_id', 'Neighborhood Id:') !!}
    {!! Form::text('neighborhood_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Latitude Field -->
<div class="form-group col-sm-6">
    {!! Form::label('latitude', 'Latitude:') !!}
    {!! Form::text('latitude', null, ['class' => 'form-control']) !!}
</div>

<!-- Longitude Field -->
<div class="form-group col-sm-6">
    {!! Form::label('longitude', 'Longitude:') !!}
    {!! Form::text('longitude', null, ['class' => 'form-control']) !!}
</div>

<!-- User Owner Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_owner_id', 'User Owner Id:') !!}
    {!! Form::text('user_owner_id', null, ['class' => 'form-control']) !!}
</div>



<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('properties.index') }}" class="btn btn-default">Cancel</a>
</div>
