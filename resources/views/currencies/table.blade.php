<div class="table-responsive">
    <table class="table" id="currencies-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Symbol</th>
        <th>Value</th>
        <th>Status</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($currencies as $currency)
            <tr>
                <td>{{ $currency->name }}</td>
            <td>{{ $currency->symbol }}</td>
            <td>{{ $currency->value }}</td>
            <td>{{ $currency->status }}</td>
                <td>
                    {!! Form::open(['route' => ['currencies.destroy', $currency->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('currencies.show', [$currency->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('currencies.edit', [$currency->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
