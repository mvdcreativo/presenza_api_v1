<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $transaction->id }}</p>
</div>

<!-- User Owner Id Field -->
<div class="form-group">
    {!! Form::label('user_owner_id', 'User Owner Id:') !!}
    <p>{{ $transaction->user_owner_id }}</p>
</div>

<!-- User Customer Id Field -->
<div class="form-group">
    {!! Form::label('user_customer_id', 'User Customer Id:') !!}
    <p>{{ $transaction->user_customer_id }}</p>
</div>

<!-- Property Id Field -->
<div class="form-group">
    {!! Form::label('property_id', 'Property Id:') !!}
    <p>{{ $transaction->property_id }}</p>
</div>

<!-- Transaction Type Id Field -->
<div class="form-group">
    {!! Form::label('transaction_type_id', 'Transaction Type Id:') !!}
    <p>{{ $transaction->transaction_type_id }}</p>
</div>

<!-- Value Field -->
<div class="form-group">
    {!! Form::label('value', 'Value:') !!}
    <p>{{ $transaction->value }}</p>
</div>

<!-- Currency Id Field -->
<div class="form-group">
    {!! Form::label('currency_id', 'Currency Id:') !!}
    <p>{{ $transaction->currency_id }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $transaction->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $transaction->updated_at }}</p>
</div>

