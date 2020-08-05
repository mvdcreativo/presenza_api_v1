<!-- Property Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('property_id', 'Property Id:') !!}
    {!! Form::text('property_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_id', 'Status Id:') !!}
    {!! Form::text('status_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Transaction Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('transaction_type_id', 'Transaction Type Id:') !!}
    {!! Form::text('transaction_type_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Currency Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('currency_id', 'Currency Id:') !!}
    {!! Form::text('currency_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', 'Price:') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('publications.index') }}" class="btn btn-default">Cancel</a>
</div>
