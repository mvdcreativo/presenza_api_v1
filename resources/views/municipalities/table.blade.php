<div class="table-responsive">
    <table class="table" id="municipalities-table">
        <thead>
            <tr>
                <th>Name</th>
        <th>Code</th>
        <th>City Id</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($municipalities as $municipality)
            <tr>
                <td>{{ $municipality->name }}</td>
            <td>{{ $municipality->code }}</td>
            <td>{{ $municipality->city_id }}</td>
                <td>
                    {!! Form::open(['route' => ['municipalities.destroy', $municipality->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('municipalities.show', [$municipality->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('municipalities.edit', [$municipality->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
