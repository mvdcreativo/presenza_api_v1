<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $publication->id }}</p>
</div>

<!-- Property Id Field -->
<div class="form-group">
    {!! Form::label('property_id', 'Property Id:') !!}
    <p>{{ $publication->property_id }}</p>
</div>

<!-- Status Id Field -->
<div class="form-group">
    {!! Form::label('status_id', 'Status Id:') !!}
    <p>{{ $publication->status_id }}</p>
</div>

<!-- Transaction Type Id Field -->
<div class="form-group">
    {!! Form::label('transaction_type_id', 'Transaction Type Id:') !!}
    <p>{{ $publication->transaction_type_id }}</p>
</div>

<!-- Currency Id Field -->
<div class="form-group">
    {!! Form::label('currency_id', 'Currency Id:') !!}
    <p>{{ $publication->currency_id }}</p>
</div>

<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', 'Price:') !!}
    <p>{{ $publication->price }}</p>
</div>

