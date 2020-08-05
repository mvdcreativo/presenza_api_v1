<div class="table-responsive">
    <table class="table" id="publications-table">
        <thead>
            <tr>
                <th>Property Id</th>
        <th>Status Id</th>
        <th>Transaction Type Id</th>
        <th>Currency Id</th>
        <th>Price</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($publications as $publication)
            <tr>
                <td>{{ $publication->property_id }}</td>
            <td>{{ $publication->status_id }}</td>
            <td>{{ $publication->transaction_type_id }}</td>
            <td>{{ $publication->currency_id }}</td>
            <td>{{ $publication->price }}</td>
                <td>
                    {!! Form::open(['route' => ['publications.destroy', $publication->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('publications.show', [$publication->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('publications.edit', [$publication->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
