<div class="table-responsive">
    <table class="table" id="expenses-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Description</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($expenses as $expense)
            <tr>
                <td>{{ $expense->name }}</td>
            <td>{{ $expense->description }}</td>
                <td>
                    {!! Form::open(['route' => ['expenses.destroy', $expense->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('expenses.show', [$expense->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('expenses.edit', [$expense->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
