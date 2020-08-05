<div class="table-responsive">
    <table class="table" id="transactionTypes-table">
        <thead>
            <tr>
                <th>Name</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($transactionTypes as $transactionType)
            <tr>
                <td>{{ $transactionType->name }}</td>
                <td>
                    {!! Form::open(['route' => ['transactionTypes.destroy', $transactionType->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('transactionTypes.show', [$transactionType->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('transactionTypes.edit', [$transactionType->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
