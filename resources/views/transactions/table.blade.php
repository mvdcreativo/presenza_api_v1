<div class="table-responsive">
    <table class="table" id="transactions-table">
        <thead>
            <tr>
                <th>User Owner Id</th>
        <th>User Customer Id</th>
        <th>Property Id</th>
        <th>Transaction Type Id</th>
        <th>Value</th>
        <th>Currency Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($transactions as $transaction)
            <tr>
                <td>{{ $transaction->user_owner_id }}</td>
            <td>{{ $transaction->user_customer_id }}</td>
            <td>{{ $transaction->property_id }}</td>
            <td>{{ $transaction->transaction_type_id }}</td>
            <td>{{ $transaction->value }}</td>
            <td>{{ $transaction->currency_id }}</td>
                <td>
                    {!! Form::open(['route' => ['transactions.destroy', $transaction->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('transactions.show', [$transaction->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('transactions.edit', [$transaction->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
