<!-- User Owner Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_owner_id', 'User Owner Id:') !!}
    {!! Form::text('user_owner_id', null, ['class' => 'form-control']) !!}
</div>

<!-- User Customer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_customer_id', 'User Customer Id:') !!}
    {!! Form::text('user_customer_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Property Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('property_id', 'Property Id:') !!}
    {!! Form::text('property_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Transaction Type Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('transaction_type_id', 'Transaction Type Id:') !!}
    {!! Form::text('transaction_type_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Value Field -->
<div class="form-group col-sm-6">
    {!! Form::label('value', 'Value:') !!}
    {!! Form::text('value', null, ['class' => 'form-control']) !!}
</div>

<!-- Currency Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('currency_id', 'Currency Id:') !!}
    {!! Form::text('currency_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('transactions.index') }}" class="btn btn-default">Cancel</a>
</div>
