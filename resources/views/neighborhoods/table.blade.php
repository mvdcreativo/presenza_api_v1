<div class="table-responsive">
    <table class="table" id="neighborhoods-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Code</th>
        <th>Municipality Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($neighborhoods as $neighborhood)
            <tr>
                <td>{{ $neighborhood->name }}</td>
            <td>{{ $neighborhood->code }}</td>
            <td>{{ $neighborhood->municipality_id }}</td>
                <td>
                    {!! Form::open(['route' => ['neighborhoods.destroy', $neighborhood->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('neighborhoods.show', [$neighborhood->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('neighborhoods.edit', [$neighborhood->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
